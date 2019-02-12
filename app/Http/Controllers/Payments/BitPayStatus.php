<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Plans\PlanOrder;
use App\Http\Controllers\Payments\HistoryController;
use App\Http\Controllers\Auth\RegisterController;
use Redirect;
use DB;

class BitPayStatus
{
    public function index(){

      $price = $_POST['amount']*100;
      $email = '';
      $user_id = '';

      if(strstr($_POST['posData'],",")){
        $email = strstr($_POST['posData'], ',', true);
        $pass = substr(strrchr($_POST['posData'], ","), 1);

        $register = array(
          'name' => 'Not Set',
          'email' => $email,
          'password' => $pass
        );

        RegisterController::create($register);
      }
      else {
        $user_id = $_POST['posData'];
      }

      if($_POST['status'] === 'paid'){
        $plan = DB::table('plans_table')->where('price', $price)->first();

        $Order = array(
          'plan_id' => $plan->id,
          'months_limit' => $plan->months_limit,
          'email' => $email,
          'user_id' => $user_id
        );

        PlanOrder::planOrder($Order);

        $Payment =  array(
          'email' => $email,
          'user_id' => $user_id,
          'plan_name' => $plan->plan_name,
          'price' => $plan->price,
          'method' => 'Bitcoin',
          'auto_renew' => 0,
          'expiry' => time() + $plan->months_limit
        );

        HistoryController::addPayment($Payment);
      }
    }
}
