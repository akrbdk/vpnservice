<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Plans\PlanOrder;
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

      $plan = DB::table('plans_table')->where('id', $plan_id)->first();

      $months_limit = $plan->months_limit;
      $plan_price = $plan->price;

      $token = $_POST['stripeToken'];

      $customer = Customer::create(array(
        "source" => $token
      ));

      $charge = Charge::create(array(
        "amount" => $plan_price*100,
        "currency" => "usd",
        "description" => 'some desc',
        "customer" => $customer->id
      ));

      PlanOrder::planOrder($plan_id,$months_limit);
      return Redirect::to('/plans')->with('alert', 'success: Subscribtion success!');
    }
}
