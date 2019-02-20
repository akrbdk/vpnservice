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

use App\Http\APIUtils\APIReply;
use App\Http\APIUtils\APICode;
use App\Http\Controllers\Plans\UserPlanInfo;

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
    public function getUserPlan(Request $request) {
        $user_id = $request->get('user_id');

        $info = new UserPlanInfo($user_id);
        $plan = $info->getPlan();
        $plan_info = $info->getPlanInfo();

        if (empty($plan) || empty($plan_info)) {
            return APIReply::err(APICode::$unknown);
        }

        $reply = [
            'id' => (int)$plan_info->plan_id,
            'name' => $plan_info->plan_name,
            'months' => (int)$plan->months_limit,
            'expiry_at' => $plan_info->expiry_at
        ];

        return APIReply::with($reply);
    }
}
