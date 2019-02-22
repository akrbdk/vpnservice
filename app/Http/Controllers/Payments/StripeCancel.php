<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Subscription;

class StripeCancel
{
  public static function index($autopay_id)
  {
    Stripe::setApiKey("sk_test_TeCUGZbQWD2dhgeTqufmvhsE");

    $sub = Subscription::retrieve($autopay_id);
    $sub->cancel();
  }
}
