<?php

namespace App\Http\Controllers\Plans;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UserPlanInfo extends Controller
{

    public $user_plan;

    public function __construct($userId){
        $this -> user_plan = DB::table('users_plans')->where('user_id', $userId)->first();
    }

    public function getPlan(){
        if(!empty($user_plan)){
          return $this->user_plan;
        }
        else {
          return 'No plan';
        }
    }

    public function isExpired(){

      $plan = $this->user_plan;

      if($plan->expiry_at <= time()){
        return 0;
      }
      else {
        return 1;
      }
    }
}
