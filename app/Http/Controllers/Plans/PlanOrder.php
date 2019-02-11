<?php

namespace App\Http\Controllers\Plans;

use Illuminate\Http\Request;
use Auth;
use DB;

class planOrder
{
    public static function planOrder($data)
    {
        if(!empty($data['email'])){
          $user_id = DB::table('users')->where('email', $data['email'])->value('id');
        }
        elseif(!empty($data['user_id'])){
          $user_id = $data['user_id'];
        }
        else {
          $user_id = Auth::id();
        }
          $plan_id = $data['plan_id'];
          $months_limit = $data['months_limit'];

        if (!empty($user_id) && !empty($plan_id))
        {
            $planInfoArr = [
                'user_id' => $user_id,
                'plan_id' => $plan_id,
                'expiry_at' => time() + (int)$months_limit
            ];
            if(!empty($data['email']) || $plan_id === '1'){
              return DB::table('users_plans')->insert($planInfoArr);
            }
            else {
              return DB::table('users_plans')->where('user_id', $user_id)->update($planInfoArr);
            }

        }
        else {
          return "Exeption";
        }
    }
}
