<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Plans\UserPlanInfo as Plan;
use Auth;

class PlansTable extends Model
{
    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'plans_table';

    public static function isHidden(){
      $data = '';
      $userId = Auth::id();
      $plan = new Plan($userId);

      if(!empty($userId)){
        $planid = $plan->user_plan->plan_id;
        if($planid !== 1 || !$plan->isExpired()){
          $data = 'hidden';
        }
      }
      return $data;
    }
}
