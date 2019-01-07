<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\User;
use Validator;

class PlansController extends Controller
{
    public function planOrder(Request $request)
    {
        $request = $request->all();

        $data['ret'] = 0;

        if (Auth::check() && !empty($request['plan_id']))
        {
            $user_id = Auth::id();
            $user_plan = DB::table('users_plans')->where('user_id', $user_id)->first();
            $plan_params = DB::table('plans_table')->where('plan_alias', $request['plan_id'])->first();

            if(!empty($plan_params)){
                $planInfoArr = [
                    'user_id' => $user_id,
                    'plan_id' => $plan_params->id,
                    'expiry_at' => time() + 350
                ];

                if(!empty($user_plan)){
                    DB::table('users_plans')->where('id', $user_plan->id)->update($planInfoArr);
                } else {
                    DB::table('users_plans')->insert($planInfoArr);
                }

                $data['ret'] = 1;
            }
        }

        return $data;
    }
}