<?php

namespace App\Http\Controllers\API;
use DB;
use App\Http\APIUtils\APIReply;
use App\Http\APIUtils\APICode;

class AppInfoController
{

    /**
     * getAppInfoList api
     *
     * @return \Illuminate\Http\Response
     */
    public function getAppInfoList(){
        $allPlans = DB::table('apps_infos')->select('version', 'client', 'link_update')->get()->toArray();
        return APIReply::with(['apps' => $allPlans]);
    }
}
