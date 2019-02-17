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

        $headerToken = $request->header('token');
        $payloadToken = $request->$input['token'];
        $token = '';

        if (!empty($headerToken)) {
            $token = $headerToken;
        } else if (!empty($payloadToken)) {
            $token = $payloadToken;
        } else {
            return response()->json(['error'=> ApiController::$invalidArgument, 'description' => 'Empty token'], ApiController::$errosStatus);
        }

        $user = ApiController::checkUserPlatform($token);
        if (!$user) {
            return response()->json(['error'=> ApiController::$invalidArgument, 'description' => 'Invalid token'], ApiController::$errosStatus);
        }

        $request->merge(['user_id' => $user->id, 'user_info' => $user, 'token' => $token]);
        return $next($request);
    }
}
