<?php

namespace App\Http\Controllers\Plans;

use Illuminate\Http\Request;
use Auth;
use DB;

class planOrder
{
    public static function planOrder($plan_id, $months_limit)
    {
        $user_id = Auth::id();

        if (!empty($user_id) && !empty($plan_id))
        {
            $planInfoArr = [
                'user_id' => $user_id,
                'plan_id' => $plan_id,
                'expiry_at' => time() + (int)$months_limit
            ];
            return DB::table('users_plans')->where('user_id', $user_id)->update($planInfoArr);
        }
        else {
          return "Exeption";
        }

    }
}
