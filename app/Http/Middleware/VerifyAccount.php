<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApiController;
use Closure;

class VerifyAccount{

    public function handle($request, Closure $next) {

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, Token, Accept, Authorization, X-Request-With');
        header('Access-Control-Allow-Credentials: true');

        $checkParams = [
            'token' => $request->header('token'),
//            'platform' => $request->header('platform'),
        ];

        if(!empty($checkParams['token'])){
            $check = ApiController::checkUserPlatform($checkParams, 'y');
            if (!$check) {
                return ApiController::retAnswer(ApiController::$error, 'Invalid token', false, ApiController::$errorStatus);
            }
            return $next($request);
        }
        return $next($request);
    }
}
