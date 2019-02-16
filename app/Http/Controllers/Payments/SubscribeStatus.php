<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Plans\PlanOrder;
use App\Http\Controllers\Payments\HistoryController;

use DB;

class SubscribeStatus extends Controller
{
    public function index()
    {
      if($_POST['txn_type'] === 'recurring_payment_profile_cancel'){
        $autopay_id = $_POST['recurring_payment_id'];

        DB::table('payment_history')->where('autopay_id', $autopay_id)->update(array('auto_renew' => '0', 'autopay_id' => ''));
      }
      elseif ($_POST['txn_type'] === 'recurring_payment') {

        if($_POST['payment_status'] === 'Completed'){
          $autopay_id = $_POST['recurring_payment_id'];

          $autopay = DB::table('payment_history')->where('autopay_id', $autopay_id)->first();
          $plan = DB::table('plans_table')->where('plan_name', $autopay->plan_name)->first();

          $Order = array(
              'plan_id' => $plan->id,
              'months_limit' => $plan->months_limit,
              'email' => '',
              'user_id' => $autopay->user_id
          );

          PlanOrder::planOrder($Order);

          $Payment =  array(
              'email' => '',
              'user_id' => $autopay->user_id,
              'plan_name' => $plan->plan_name,
              'price' => $plan->price,
              'method' => 'PayPal',
              'auto_renew' => 1,
              'expiry' => time() + $plan->months_limit
          );

          HistoryController::addPayment($Payment);

        }
      }
    }
}
