<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Payments\HistoryController;

use DB;

class StripeIPN extends Controller
{
    public function index(Request $request)
    {

      $bodyContent = json_decode($request->getContent(),true);

      if($bodyContent['object']['object'] === 'subscription'){
          if($bodyContent['object']['status'] === 'canceled'){

          $autopay_id = $bodyContent['object']['id'];

          DB::table('payment_history')->where('autopay_id', $autopay_id)->update(array('auto_renew' => '0', 'autopay_id' => ''));
        }
      }
      elseif ($bodyContent['object']['object'] === 'invoice') {

        if($bodyContent['object']['status'] === 'paid'){

          $autopay_id = $bodyContent['object']['subscription'];

          $autopay = DB::table('payment_history')->where('autopay_id', $autopay_id)->first();

          DB::table('payment_history')->where('autopay_id', $autopay_id)->update(array('auto_renew' => '0', 'autopay_id' => ''));

          $plan = DB::table('plans_table')->where('id', $autopay->plan_id)->first();

          $Payment =  array(
              'email' => '',
              'user_id' => $autopay->user_id,
              'plan_id' => $autopay->plan_id,
              'plan_name' => $plan->plan_name,
              'price' => $plan->price,
              'method' => 'PayPal',
              'auto_renew' => 1,
              'months_limit' => $plan->months_limit,
              'autopay_id' => $autopay_id
          );

          HistoryController::addPayment($Payment);
        }
      }
    }
}
