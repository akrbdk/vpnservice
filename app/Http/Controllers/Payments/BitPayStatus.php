<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Payments\HistoryController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
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
        if(!empty(DB::table('users')->where('email', $email)->first())){
          return Redirect::to('/plans')->with('alert', trans('payment_err.email'));
        }
        $pass = substr(strrchr($_POST['posData'], ","), 1);

        $register = array(
          'name' => 'Not Set',
          'email' => $email,
          'password' => $pass
        );

        RegisterController::create($register);

        Auth::attempt(['email' => $email, 'password' => $pass]);
      }
      else {
        $user_id = $_POST['posData'];
      }

      if($_POST['status'] === 'paid'){
        $plan = DB::table('plans_table')->where('price', $price)->first();

        $Payment =  array(
          'email' => $email,
          'user_id' => $user_id,
          'plan_name' => $plan->plan_name,
          'plan_id' => $plan->id,
          'price' => $plan->price,
          'method' => 'Bitcoin',
          'auto_renew' => 0,
          'months_limit' => $plan->months_limit
        );

        HistoryController::addPayment($Payment);
      }
    }
}
