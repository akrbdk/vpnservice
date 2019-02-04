<?php

namespace App\Http\Controllers\Plans;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class PlanController extends Controller
{
    public function getPlan(){

      if(Auth::check()){
        $user_id = Auth::id();
        $user_plan = DB::table('users_plans')->where('user_id', $user_id)->first();

          if(!empty($user_plan)){
            return $user_plan;
          }
      }
        else {
          return 'No plan or Unloged User';
        }
    }

    public function isExpired(){

      $plan = $this->getPlan();

      //Заменить проверку на дату, когда база будет нормализована
      if($plan->expiry_at > 1){
        return 0;
      }
      else {
        return 1;
      }
    }

    public function TrialHide(){
      $TrialHide = '';

      if(Auth::check()){
        $planid = $this->getPlan()->plan_id;
        if($planid != 1 || !$this->isExpired()){
          $TrialHide = 'hidden';
        }
      }

      return $TrialHide;
    }
}
