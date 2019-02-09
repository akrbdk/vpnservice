<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Plans\PlanOrder;
use App\Http\Controllers\Auth\RegisterController;
use Redirect;
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
        $pass = $_POST['password'];

        $register = array(
          'name' => 'Not Set',
          'email' => $email,
          'password' => $pass
        );

        RegisterController::create($register);
      }

      $plan = DB::table('plans_table')->where('id', $plan_id)->first();

      $Order = array(
        'plan_id' => $plan_id,
        'months_limit' => $plan->months_limit,
        'email' => $email
      );

      $token = $_POST['stripeToken'];

      $customer = Customer::create(array(
        "source" => $token
      ));

      $charge = Charge::create(array(
        "amount" => $plan->price*100,
        "currency" => "usd",
        "description" => 'some desc',
        "customer" => $customer->id
      ));

      PlanOrder::planOrder($Order);
      return Redirect::to('/plans')->with('alert', 'success: Subscribtion success!');
    }
}
