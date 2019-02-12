<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
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
      $hasTrial = DB::table('payment_history')->where('user_id', $userId)->where('method', 'Trial')->exists();

      if(!empty($userId) && !empty($hasTrial)){
        {
          $data = 'hidden';
        }
      }
      return $data;
    }
}
