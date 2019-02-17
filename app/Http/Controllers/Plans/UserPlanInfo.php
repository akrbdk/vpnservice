<?php

namespace App\Http\Controllers\Plans;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UserPlanInfo
{

    public $user_plan;

    public function __construct($userId){
        $this -> user_plan = DB::table('users_plans')->where('user_id', $userId)->first();
    }

    public function getPlanInfo(){
      if(!empty($this->user_plan)){
        return $this->user_plan;
      }
      else {
        return 'No plan';
      }
    }

    public function isTrial()
    {
      if($this->user_plan->plan_id === 1)
      {
        return 1;
      }
      return 0;
    }

    public function isExpired(){

      $plan = $this->user_plan;

      return $plan->expiry_at <= time();
    }
}
