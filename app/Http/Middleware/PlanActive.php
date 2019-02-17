<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\APIUtils\APIReply;
use App\Http\APIUtils\APICode;
use App\Http\Controllers\Plans\UserPlanInfo as Plan;
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
        $hwid = $request->get('hwid');

        $plan = new Plan($id);
        $request->request->add($plan->getUserPlan());

        if($plan->isExpired()){
          return APIReply::err(APICode::$invArgument, 'Plan is expired!!');
        }
        if($plan->isTrial()){
            $isHWID = DB::table('trial_hwid')->where('hwid', $hwid)->first();
            if(!empty($isHWID)){
              return APIReply::err(APICode::$invArgument, 'HWID existed');
            }
            DB::table('trial_hwid')->insert(array('hwid' => $hwid));
        }
        return $next($request);
    }
}
