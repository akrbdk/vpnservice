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
    protected static $errorStatus = 400;

    protected static $success = 0;
    protected static $error = 1;

    protected static $successCheck = 'Ok';
    protected static $errorCheck = 'Error';

    public function __construct()
    {

    }

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

    protected static function checkUserPlatform($params, $checkTokenType = ''){

        $user = false;

        if(!empty($checkTokenType) && !empty($params['uuid']) && !empty($params['token'])){

            $user = DB::table('users')
                ->where('server_uuid', $params['uuid'])
                ->where('activation_token_mobile', $params['token'])
                ->orWhere(function($query) use ($params)
                {
                    $query->where('activation_token_desctop', $params['token'])
                        ->where('server_uuid', $params['uuid']);
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
