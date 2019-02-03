<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\User;
use App\PlansTable;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use GuzzleHttp\Client;

class PlansController extends ApiController
{

    /**
     * getUserPlan api
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserPlan(Request $request){

        $input = $request->all();

        if($user = parent::checkUserPlatform($input, 'y')){

            $userPlan = (array)DB::table('plans_table')
                ->join('users_plans', function($join) use($user)
                {
                    $join->on('plans_table.id', '=', 'users_plans.plan_id')
                        ->where('users_plans.user_id', $user->id);
                })
                ->first();

            if(!empty($userPlan)){
                return response()->json([
                    'error'=> 0,
                    'payload' => array(
                        'id' => (int)$userPlan['plan_id'],
                        'name' => $userPlan['plan_name'],
                        'months' => (int)$userPlan['months_limit'],
                        'expiry_at' => $userPlan['expiry_at']
                    )], parent::$successStatus);
            } else {
                return response()->json(['error'=> 0, 'payload' => array('id' => 1, 'name' => 'Basic', 'expiry_at' => time() + 350)], parent::$successStatus);
            }
        }

        return parent::answer(parent::$error, '', 'Unathorized', parent::$errorCheck, parent::$errorStatus);
    }
}
