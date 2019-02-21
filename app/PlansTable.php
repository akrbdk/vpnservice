<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class PlansTable
{
    /**
     * Таблица, связанная с моделью.
     *
     * @var string
     */
    protected $table = 'card_view';
    private $plans;
    private $cards;

    public function __construct() {
      $plans = DB::table('plans_table')->select('id','price','months_limit')->orderBy('id')->get();
      $cards = DB::table('card_view')->get();
      for
    }

    public function getPrice($plandId) {
      foreach ($this->plans as $plan) {
        if ($plan->id === (int)$plandId) return $plan->price;
      }
    }

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
