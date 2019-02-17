<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\APIUtils\APIReply;
use App\Http\APIUtils\APICode;

use DB;

class dnsController
{
    public function getList(Request $request)
    {
      $dnsArr = [];
      $dnsList = DB::table('dns_servers')->get();
      if(!empty($dnsList)){
          foreach ($dnsList as $dns){
              $dnsArr[] = $dns->ip;
          }
      }
      return APIReply::with(['servers' => $dnsArr]);
    }
}
