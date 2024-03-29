<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;

use App\Http\APIUtils\APIReply;
use App\Http\APIUtils\APICode;
use App\Http\Controllers\Plans\UserPlanInfo;

class UserController extends Controller
{

    /**
     * login api
     *
     * type: POST
     *
     * request body:
     * string $email - User Email
     * string $password - User password
     * string $platform - Device platform
     *
     * headers body
     * Content-Type - application/json
     * token - User token
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        $input = $request->all();

        if ( !isset($input['platform']) || !isset($input['hwid'])) {
            return APIReply::err(APICode::$invArgument, 'Empty platform or HWID');
        }

        if (!Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            return APIReply::err(APICode::$invArgument, 'Invalid username or password');
        }

        $user = Auth::user();

        $plan = new UserPlanInfo($user->id);
        if ($plan->isExpired()){
            return APIReply::err(APICode::$planExpired);
        }

        if ($plan->isTrial()) {
            $hwid = DB::table('trial_hwid')->where('hwid', $input['hwid'])->first();
            if (!empty($hwid) && $hwid->expiry_at < time()) {
                return APIReply::err(APICode::$HWIDexisted);
            }
        }

        $input['platform'] = trim(htmlentities($input['platform']));
        $user_session = DB::table('sessions')->where('user_id', $user->id)->where('platform', $input['platform'])->first();
        $token = str_random(60);

        $userSessionInfoArr = [
            'user_id' => $user->id,
            'token' => $token,
            'platform' => $input['platform'],
            'expiry_at' => time() + (3 * 24 * 60 * 60)
        ];

        if(empty($user_session)){
            DB::table('sessions')->insert($userSessionInfoArr);
        } else {
            DB::table('sessions')
                ->where('user_id', $user->id)
                ->where('platform', $input['platform'])
                ->update($userSessionInfoArr);
        }

        return APIReply::with(['token' => $token]);
    }

    /**
     * * details api
     *
     * * type: POST
     *
     * * headers body
     * Content-Type - application/json
     * token - User token
     *
     * * OR *
     *
     * * request body:
     * string $token - User token
     * string $platform - Device platform
     *
     * @return \Illuminate\Http\Response
     */
    public function checkToken(Request $request) {
        return APIReply::ok();
    }
}
