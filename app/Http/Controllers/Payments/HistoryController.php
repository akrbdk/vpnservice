<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use Auth;
use DB;

class HistoryController
{
    public static function addPayment($data){
      if(!empty($data['email'])){
        $user_id = DB::table('users')->where('email', $data['email'])->value('id');
      }
      elseif(!empty($data['user_id'])){
        $user_id = $data['user_id'];
      }
      else {
        $user_id = Auth::id();
      }

      $planInfoArr = [
          'user_id' => $user_id,
          'plan_name' => $data['plan_name'],
          'price' => $data['price'],
          'method' => $data['method'],
          'auto_renew' => 0,
          'expiry_at' => $data['expiry']
      ];

      return DB::table('payment_history')->insert($planInfoArr);
    }
}
