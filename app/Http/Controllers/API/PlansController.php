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
     * * headers body
     * Content-Type - application/json
     * token - User token
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserPlan(Request $request){

        $user_id = $request->get('user_id');
        $userPlan = (array)DB::table('plans_table')
            ->join('users_plans', function($join) use($user_id)
            {
                $join->on('plans_table.id', '=', 'users_plans.plan_id')
                    ->where('users_plans.user_id', $user_id);
            })
            ->first();

        if(!empty($userPlan)){
            return parent::retAnswer(
                parent::$success,
                false,
                [
                    'id' => (int)$userPlan['plan_id'],
                    'name' => $userPlan['plan_name'],
                    'months' => (int)$userPlan['months_limit'],
                    'expiry_at' => $userPlan['expiry_at']
                ],
                parent::$successStatus);
        } else {
            return response()->json(['error'=> 0, 'payload' => array('id' => 1, 'name' => 'Basic', 'expiry_at' => time() + 350)], parent::$successStatus);
        }
    }
}
