<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAccount{

    public function handle($request, Closure $next) {

        if ($request->user()->verified) {
            return $next($request);
        } else {
            return response('Unauthorized.', 401);
        }

    }
}
