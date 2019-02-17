<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\APIUtils\APIReply;
use App\Http\APIUtils\APICode;
use DB;

class PlanActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->get('user_id');
        $hwid = 'test123';

        $plan = DB::table('users_plans')->where('user_id', $id)->first();

        if($plan->expiry_at > time()){
          if($plan->plan_id === '1'){
            $isHWID = DB::table('users_plans')->where('hwid', $hwid)->first();
            if(empty($isHWID)){
              DB::table('users_plans')->where('user_id', $id)->update(array('hwid' => $hwid));
              return $next($request);
            }else{
              return APIReply::err(APICode::$invArgument, 'HWID existed');
            }
          }
          else {
            return $next($request);
          }
        }
        else {
          return APIReply::err(APICode::$invArgument, 'Plan is expired!!');
        }
    }
}
