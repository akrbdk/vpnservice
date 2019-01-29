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
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        $input = $request->all();

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            if (parent::checkPlanExpired($user['id']))  {
                return response()->json(['error' => parent::$planExpired, 'description' => 'Plan expired'], parent::$errorStatus);
            }

            $token = false;

            if(!empty($input['platform'])){
                $input['platform'] = trim(htmlentities($input['platform']));

                switch ($input['platform']) {
                    case "pc":
                        $token = $user->activation_token_desctop = str_random(60);
                        break;
                    case "mobile":
                        $token = $user->activation_token_mobile = str_random(59);
                        break;
                }

                if($token){
                    $user->update();

                    return response()->json(['error' => parent::$success, 'payload' => ['token' => $token]], parent::$successStatus);
                }
            }

        }

        return response()->json(['error'=>1, 'description' => 'Invalid login or password'], parent::$errorStatus);
    }

    /**
     * Register api
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
        if (count($user) !== 1) {
            return response()->json(['error' => 1, 'description' => 'Invalid token'], parent::$errorStatus);
        }

        if (parent::checkPlanExpired($user->id))  {
            return response()->json(['error' => parent::$planExpired, 'description' => 'Plan expired'], parent::$errorStatus);
        }

        return response()->json(['error'=> 0], parent::$successStatus);
    }
}
