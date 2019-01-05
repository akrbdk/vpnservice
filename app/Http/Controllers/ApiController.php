<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App;
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
}
