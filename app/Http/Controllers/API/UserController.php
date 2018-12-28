<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{

    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){

            $user = Auth::user();
            $input = $request->all();
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
                    return response()->json(['error' => 0, 'payload' => ['token' => $token]], $this-> successStatus);
                }
            }
        }

        return response()->json(['error'=>1, 'description' => 'Unauthorised', 'payload' => array('token' => '')], 401);
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            return response()->json(['error'=>2, 'description' => 'User is already exists', 'payload' => array('token' => '')], 401);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 2, 'description' => $validator->errors(), 'payload'=>['token' => '']], 401);
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
        return response()->json(['error' => 0, 'payload'=>$success], $this-> successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function checkToken(Request $request)
    {
        $input = $request->all();
        $user = false;

        if(!empty($input['platform']) && !empty($input['token'])){
            $input['platform'] = trim(htmlentities($input['platform']));

            switch ($input['platform']) {
                case "pc":
                    $user = User::where('activation_token_desctop', $input['token'])->first();
                    break;
                case "mobile":
                    $user = User::where('activation_token_mobile', $input['token'])->first();
                    break;
            }

            if($user){
                return response()->json(['error'=> 0, 'description' => $user, 'payload' => array('check' => 'Ok')], $this-> successStatus);
            }
        }

        return response()->json(['error'=> 1, 'description' => $input, 'payload' => array('check' => 'Error')], 401);
    }
}
