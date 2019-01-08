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

    protected static $successStatus = 200;
    protected static $errorStatus = 200;

//    protected static $apiAuthUser = true;

    protected static $success = 0;
    protected static $error = 1;

    protected static $successCheck = 'Ok';
    protected static $errorCheck = 'Error';

//    public function __construct(Request $request)
//    {
//
//        $input = array();
//        $input['token'] = $request->header('Authorization');
//
//        if(!empty($headerAuth)){
//            $user = self::checkUserPlatform($input, 'y');
//            if(empty($user)){
//                self::$apiAuthUser = false;
//            }
//        }
//
//    }

    protected static function answer($error, $details, $description, $check, $status){

        return response()->json(
            [
                'error'=> $error,
                'details' => $details,
                'description' => $description,
                'payload' => array(
                    'check' => $check
                )
            ], $status
        );
    }

    protected static function checkUserPlatform($params=array(), $checkTokenType = ''){

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
