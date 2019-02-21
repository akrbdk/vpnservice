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
    public function index(Request $request) {
      $raw_post_data = file_get_contents('php://input');
      $ipn = json_decode($raw_post_data, true);
      if ($ipn['status'] !== 'paid') return;

      $posData = json_decode($ipn['posData'], true);
      $plan = DB::table('plans_table')->where('id', $posData['plan_id'])->first();

      $payment = [
        'email' => $ipn['buyerFields']['buyerEmail'],
        'plan_name' => $plan->plan_name,
        'plan_id' => $plan->id,
        'price' => $plan->price,
        'method' => 'Bitcoin',
        'auto_renew' => 0,
        'months_limit' => $plan->months_limit
      ];

      HistoryController::addPayment($payment);
    }
}
