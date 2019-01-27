<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User;
use App\AppsInfo;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use GuzzleHttp\Client;

class AppInfoController extends ApiController
{

    /**
     * getAppInfoList api
     *
     * @return \Illuminate\Http\Response
     */
    public function getAppInfoList(){

        $allPlans = AppsInfo::all()->toArray();

        if(!empty($allPlans)){
            return response()->json(['error'=> 0, 'payload' => array('apps' => $allPlans)], parent::$successStatus);

        }

        return parent::answer(parent::$error, '', 'Empty plans table', parent::$errorCheck, parent::$errorStatus);
    }
}
