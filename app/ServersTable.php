<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ServersTable extends Model
{
    public static function index(){

      $data = DB::table('server_infos')
                 ->select('country_iso', DB::raw('count(*) as total'))
                 ->groupBy('country_iso')
                 ->get();
      return $data;
    }
}
