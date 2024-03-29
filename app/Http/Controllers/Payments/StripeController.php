<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Payments\HistoryController;
use App\Http\Controllers\Auth\RegisterController;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

use DB;

class StripeController
{
    public function payWithstripe(){

      Stripe::setApiKey('sk_test_TeCUGZbQWD2dhgeTqufmvhsE');

      $plan_id = $_POST['plan_id'];

      $email = '';

      if(isset($_POST['password'])){
        $email = $_POST['email'];
        if(!empty(DB::table('users')->where('email', $email)->first())){
          return Redirect::to('/plans')->with('alert', trans('payment_err.email'));
        }
        $pass = $_POST['password'];

        $register = array(
          'name' => 'Not Set',
          'email' => $email,
          'password' => $pass
        );

        RegisterController::create($register);

        Auth::attempt(['email' => $email, 'password' => $pass]);
      }

      $token = $_POST['stripeToken'];

      $stripe_email = (isset($_POST['password'])) ? $email : Auth::user()->email;

      $customer = Customer::create(array(
        "email" => $stripe_email,
        "source" => $token
      ));

      $plan = DB::table('plans_table')->where('id', $plan_id)->first();

      $charge = Charge::create(array(
        "amount" => $plan->price,
        "currency" => "usd",
        "description" => $plan->plan_name,
        "customer" => $customer->id
      ));

      $Payment =  array(
        'email' => $email,
        'plan_name' => $plan->plan_name,
        'plan_id' => $plan->id,
        'price' => $plan->price,
        'method' => 'Card',
        'auto_renew' => 0,
        'months_limit' => $plan->months_limit
      );

      HistoryController::addPayment($Payment);

      return Redirect::to('/admin')->with('alert-success', trans('payment_err.success'));
    }
}
