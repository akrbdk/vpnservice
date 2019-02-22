<?php

namespace App\Http\Middleware;

use App\Http\APIUtils\APIReply;
use App\Http\APIUtils\APICode;
use App\Http\Controllers\ApiController;
use DB;
use Closure;

class VerifyAccount{

    public function handle($request, Closure $next) {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, Token, Accept, Authorization, X-Request-With');
        header('Access-Control-Allow-Credentials: true');

        $input = $request->all();

        $headerToken = $request->header('token');
        $token = '';

        if (!empty($headerToken)) {
            $token = $headerToken;
        } else if (isset($input['token'])) {
            $token = $input['token'];
        } else {
            return APIReply::err(APICode::$invArgument, 'Empty token');
        }

        /*
            SELECT users.* FROM users
            INNER JOIN sessions ON sessions.user_id = users.id
            WHERE sessions.token = 'test_token';
        */
        $user = DB::table('users')
                ->join('sessions', 'users.id', '=', 'sessions.user_id')
                ->where('sessions.token', '=', $token)
                ->first();

        if (empty($user)) {
            return APIReply::err(APICode::$invArgument, 'Invalid token');
        }

        $request->merge(['user_id' => $user->id, 'user_info' => $user, 'token' => $token]);
        return $next($request);
    }
}
