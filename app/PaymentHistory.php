<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;

class PaymentHistory extends Model
{
    public static function index($id){

      $data = DB::table('payment_history')->get()->where('user_id', $id);

      return $data;
    }
}
