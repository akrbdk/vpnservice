<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App;
use DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Cookie;
use Request;
use Config;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static $successStatus = 200;
    public static $errorStatus = 200;

    // System errors starts from 0
    public static $success = 0;
    public static $error = 1;
    public static $invalidArgument = 2;
    public static $unknownError = 3;

    // Custom errors starts from 10
    public static $planExpired = 10;

    public static $successCheck = 'Ok';
    public static $errorCheck = 'Error';


    public static function retAnswer($error, $description=false, $payload=false, $status){

        $answer = [
            'error'=> $error,
        ];
        if($description && !empty($description)){
            $answer['description'] = $description;
        }
        if($payload && !empty($payload)){
            $answer['payload'] = [
                $payload
            ];
        }
        return response()->json($answer, $status);
    }

    protected static function checkPlanExpired($user_id) {
        $result = DB::select('SELECT expiry_at FROM users_plans WHERE user_id = ? LIMIT 1', [$user_id]);
        if (count($result) === 0) return false;
        return $result[0]->expiry_at < time();
    }

    public static function checkUserPlatform($params=array(), $checkTokenType = ''){

        $user = false;

        if(!empty($checkTokenType) && !empty($params['token'])){

            $user = DB::table('users')
                ->where('activation_token_desctop', $params['token'])
                ->orWhere(function($query) use ($params)
                {
                    $query->where('activation_token_mobile', $params['token']);
                })
                ->first();

            return $user;
        }
        if(!empty($params['platform']) && !empty($params['token'])){
            switch (trim(htmlentities($params['platform']))) {
                case "pc":
                    $user = DB::table('users')->where('activation_token_desctop', $params['token'])->first();
                    break;
                case "mobile":
                    $user = DB::table('users')->where('activation_token_mobile', $params['token'])->first();
                    break;
            }
        }

        return $user;
    }
}
