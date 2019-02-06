<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends ApiController
{

    /**
     * login api
     *
     * type: POST
     *
     * request body:
     * string $email - User Email
     * string $password - User password
     * string $platform - Device platform
     *
     * headers body
     * Content-Type - application/json
     * token - User token
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        $input = $request->all();

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();

            //if plan expired
            if (parent::checkPlanExpired($user['id'])){
                return parent::retAnswer(parent::$planExpired, 'Plan expired', false, parent::$errorStatus);
            }

            //update platform token
            if(!empty($input['platform'])){
                $input['platform'] = trim(htmlentities($input['platform']));
                switch ($input['platform']) {
                    case "pc":
                        $token = $user->activation_token_desctop = str_random(60);
                        break;
                    case "mobile":
                        $token = $user->activation_token_mobile = str_random(59);
                        break;
                    default:
                        $token = false;
                }

                if($token){
                    $user->update();
                    return parent::retAnswer(parent::$success, false, ['token' => $token], parent::$successStatus);
                }
            }

        }

        return parent::retAnswer(parent::$error, 'Invalid login or password', false, parent::$errorStatus);
    }

    /**
     * Register api
     *
     * * type: POST
     *
     * request body:
     * string $token - User token
     * string $platform - Device platform
     *
     * headers body
     * Content-Type - application/json
     * token - User token
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            return response()->json(['error'=>2, 'description' => 'User is already exists', 'payload' => array('token' => '')], parent::$errorStatus);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 2, 'description' => $validator->errors(), 'payload'=>['token' => '']], parent::$errorStatus);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['activation_token_desctop'] = str_random(60);
        $input['activation_token_mobile'] = str_random(59);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyAppAuth')-> accessToken;
        $success['name'] =  $user->name;
        $success['activation_token_desctop'] =  $user->activation_token_desctop;
        $success['activation_token_mobile'] =  $user->activation_token_mobile;
        return response()->json(['error' => 0, 'payload'=>$success], parent::$successStatus);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function checkToken(Request $request)
    {
        $input = $request->all();

        $user = parent::checkUserPlatform($input);
        if (!$user) {
            return parent::retAnswer(parent::$error, 'Invalid token', false, parent::$errorStatus);
        }

        //check active plan
        if (parent::checkPlanExpired($user->id)){
            return parent::retAnswer(parent::$planExpired, 'Plan expired', false, parent::$errorStatus);
        }

        return parent::retAnswer(parent::$success, false, false, parent::$successStatus);

    }
}
