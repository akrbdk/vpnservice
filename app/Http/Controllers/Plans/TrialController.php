<?php

namespace App\Http\Controllers\Plans;

use Illuminate\Http\Request;
use App\Http\Controllers\Plans\PlanOrder;
use App\Http\Controllers\Auth\RegisterController;
use Redirect;
use DB;

class TrialController
{
    public function index()
    {
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

      PlanOrder::planOrder($Order);
      return Redirect::to('/plans')->with('alert', 'success: Subscribtion success!');
    }
}
