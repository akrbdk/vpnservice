<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use Auth;
use DB;

class HistoryController
{
    public static function addPayment($data){
      $auto = (!empty($data['auto_renew'])) ? $data['auto_renew'] : 0;

      if(!empty($data['email'])){
        $user_id = DB::table('users')->where('email', $data['email'])->value('id');
      }
      elseif(!empty($data['user_id'])){
        $user_id = $data['user_id'];
      }else {
        $user_id = Auth::id();
      }

      $expiry = $data['months_limit'] + time();

      $last_plan = DB::table('payment_history')->where('user_id', $user_id)->where('expiry_at','>', time())->orderBy('expiry_at', 'desc')->first();

      if(!empty($last_plan)){
        $expiry = $data['months_limit'] + $last_plan->expiry_at;
      }

      $planInfoArr = [
          'user_id' => $user_id,
          'plan_id' => $data['plan_id'],
          'plan_name' => $data['plan_name'],
          'price' => $data['price'],
          'method' => $data['method'],
          'auto_renew' => $auto,
          'expiry_at' => $expiry
      ];

      return DB::table('payment_history')->insert($planInfoArr);
    }
}
