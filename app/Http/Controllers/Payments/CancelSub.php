<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payments\PayPalCancel;
use App\Http\Controllers\Payments\StripeCancel;

use Auth;
use Redirect;
use DB;

class CancelSub extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $autopay = DB::table('payment_history')->where('autopay_id', '<>', '')->where('user_id', $user_id)->first();

        if(empty($autopay)){
          return Redirect::to('/admin/payment-history')->with('alert', trans('payment_err.no_sub'));
        }

        switch ($autopay->method) {
          case 'PayPal':
            $cancel = new PayPalCancel;
            $cancel->index($autopay->autopay_id);
          break;

          case 'Card':
            StripeCancel::index($autopay->autopay_id);
          break;
        }
        return Redirect::to('/admin/payment-history')->with('alert', trans('payment_err.cancel_success'));
    }
}
