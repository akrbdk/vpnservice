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

        $input = $request->all();
        $checkParams = ['token' => $request->header('token')];

        if(!empty($checkParams['token']) || (!empty($input['platform']) && !empty($input['token']))){
            $check = ApiController::checkUserPlatform($checkParams, 'y');
            $user = !empty($check) ? $check : ApiController::checkUserPlatform($input);
            if (!$user) {
                return ApiController::retAnswer(ApiController::$error, 'Invalid token', false, ApiController::$errorStatus);
            }

            $request->merge(['user_id' => $user->id, 'user_info' => $user]);
            return $next($request);
        }

        return ApiController::retAnswer(ApiController::$error, 'Invalid token', false, ApiController::$errorStatus);
    }
}
