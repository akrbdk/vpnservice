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

        $token = !empty($request->header('token'))
            ? $request->header('token')
            : (!empty($input['token'])
                ? $input['token']
                : '');

        if(!empty($token)){
            $user = ApiController::checkUserPlatform($token);
            if (!$user) {
                return ApiController::retAnswer(ApiController::$error, 'Invalid token', false, ApiController::$errorStatus);
            }

            $request->merge(['user_id' => $user->id, 'user_info' => $user]);
            return $next($request);
        }

        return ApiController::retAnswer(ApiController::$error, 'Invalid token', false, ApiController::$errorStatus);
    }
}
