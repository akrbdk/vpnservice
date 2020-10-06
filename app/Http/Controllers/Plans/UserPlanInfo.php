<?php

namespace App\Http\Controllers\Plans;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UserPlanInfo
{
    private $user_plan;
    private $plan;
    private $user_id;

    public function __construct($user_id) {
      $this->user_id = $user_id;
      $this->user_plan = null;
      $this->plan = null;
    }

    private function updateUserInfo() {
      // Get current active user plan
      // SELECT * FROM payment_history WHERE user_id = 52 AND expiry_at > 1550701264 ORDER BY expiry_at ASC LIMIT 1
      $this->user_plan = DB::table('payment_history')
                            ->where('user_id', $this->user_id)
                            ->where('expiry_at', '>', time())
                            ->orderBy('expiry_at', 'ASC')
                            ->first();

      // If no one active then get the latest
      if ( empty($this->user_plan) )  {
        $this->user_plan = DB::table('payment_history')->where('user_id', $this->user_id)->orderBy('expiry_at', 'DESC')->first();
      }
    }

    private function updatePlanInfo() {
      if (is_null($this->user_plan)) self::updateUserInfo();
      $this->plan = DB::table('plans_table')->where('id', $this->user_plan->plan_id)->first();
    }

    public function getPlanInfo() {
      if (is_null($this->user_plan)) self::updateUserInfo();
      return $this->user_plan;
    }

    public function getPlan() {
      if (is_null($this->plan)) self::updatePlanInfo();
      return $this->plan;
    }

    public function isTrial() {
      if (is_null($this->user_plan)) self::updateUserInfo();
      return $this->user_plan->plan_id === 1;
    }

    public function isExpired() {
      if (is_null($this->user_plan)) self::updateUserInfo();
      return $this->user_plan->expiry_at < time();
    }
}
