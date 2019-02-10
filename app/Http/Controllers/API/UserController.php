<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

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
                $user_session = DB::table('sessions')->where('user_id', $user->id)->where('platform', $input['platform'])->first();
                $token = str_random(60);

                $userSessionInfoArr = [
                    'user_id' => $user->id,
                    'token' => $token,
                    'platform' => $input['platform'],
                    'expiry_at' => time() + (3 * 24 * 60 * 60)
                ];

                if(empty($user_session)){
                    DB::table('sessions')->insert($userSessionInfoArr);
                }
                DB::table('sessions')
                    ->where('user_id', $user->id)
                    ->where('platform', $input['platform'])
                    ->update($userSessionInfoArr);


                return parent::retAnswer(parent::$success, false, ['token' => $token], parent::$successStatus);
            } else {
                return parent::retAnswer(parent::$error, 'Empty platform info', false, parent::$errorStatus);
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
