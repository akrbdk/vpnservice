<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Subscription;

use DB;

class StripeCancel
{
  public static function index($autopay_id)
  {
    Stripe::setApiKey("sk_test_TeCUGZbQWD2dhgeTqufmvhsE");

    try {
      $sub = Subscription::retrieve($autopay_id);
      $sub->cancel();

      DB::table('payment_history')->where('autopay_id', $autopay_id)->update(array('auto_renew' => '0', 'autopay_id' => ''));
    } catch(Stripe_CardError $e) {
      return Redirect::to('/admin/payment-history')->with('alert', trans('payment_err.cancel_err'));
    } catch (Exception $e) {
      return Redirect::to('/admin/payment-history')->with('alert', trans('payment_err.cancel_err'));
    }catch (Stripe_Error $e){
      return Redirect::to('/admin/payment-history')->with('alert', trans('payment_err.cancel_err'));
    }
  }
}
