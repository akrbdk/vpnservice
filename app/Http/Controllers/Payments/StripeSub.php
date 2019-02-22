<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Plan;
use Stripe\Customer;
use Stripe\Subscription;

use Auth;
use DB;
use Redirect;

class StripeSub extends Controller
{
  public function index()
  {
    Stripe::setApiKey('sk_test_TeCUGZbQWD2dhgeTqufmvhsE');

    $user_id = Auth::id();

    $autopay = DB::table('payment_history')->where('autopay_id', '<>', '')->where('user_id', $user_id)->first();

    if(!empty($autopay)){
      return Redirect::to('/admin/payment-history')->with('alert', trans('payment_err.has_sub'));
    }

    $plan_id = $_POST['plan_id'];
    $pay_id = $_POST['pay_id'];

    $expire = DB::table('payment_history')->where([
           ['user_id', '=', $user_id],
           ['expiry_at', '>', time()]
    ])->orderBy('expiry_at', 'desc')->first()->expiry_at;

    $plan = DB::table('plans_table')->where('id', $plan_id)->first();
    $plan_name = $plan->plan_name;

    $month = $plan->months_limit/60/60/24/30;
    $price = $plan->price;

    $stripe_plan = Plan::create([
      "amount" => $price,
      "interval" => "month",
      "interval_count" => $month,
      "product" => [
        "name" => $plan_name
      ],
      "currency" => "usd",
    ]);

    $customer = Customer::all(["email" => Auth::user()->email])->data[0];

    $subscribtion = Subscription::create([
      "customer" => $customer,
      "trial_end" => $expire,
      "items" => [
        [
          "plan" => $stripe_plan,
        ],
      ]
    ]);

    DB::table('payment_history')->where('id', $pay_id)->update(array('auto_renew' => '1', 'autopay_id' => $subscribtion->id));

    return Redirect::to('/admin')->with('alert-success', trans('payment_err.autopay'));
  }
}
