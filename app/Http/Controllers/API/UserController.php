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
     * * details api
     *
     * * type: POST
     *
     * * headers body
     * Content-Type - application/json
     * token - User token
     *
     * * OR *
     *
     * * request body:
     * string $token - User token
     * string $platform - Device platform
     *
     * @return \Illuminate\Http\Response
     */
    public function checkToken(Request $request)
    {
        //check active plan
        if (parent::checkPlanExpired($request->get('user_id'))){
            return parent::retAnswer(parent::$planExpired, 'Plan expired', false, parent::$errorStatus);
        }
        return parent::retAnswer(parent::$success, false, false, parent::$successStatus);

    }
}
