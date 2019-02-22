<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Plans\UserPlanInfo;
use Auth;
use DB;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class AdminControllerMain extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
	info('Called locale: ' . app()->getLocale());
    }

    private function convertDuration($duration) {
        $locale = app()->getLocale();
        Carbon::setlocale($locale);

        $dt = Carbon::now();

        $months = $dt->diffInMonths($dt->copy()->addSeconds($duration));
        if ($months > 0) return CarbonInterval::months($months);

        $days = $dt->diffInDays($dt->copy()->addSeconds($duration));
        if ($days > 0) return CarbonInterval::days($days);

        return 0;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $info = new UserPlanInfo($user_id);

        $user_plan = $info->getPlanInfo();
        $plan_params = $info->getPlan();
        $months_limit = self::convertDuration((int)$plan_params->months_limit);
        $latestApp = DB::table('apps_infos')->orderBy('version', 'desc')->first();

        return view('admin.index', [
            'page_key' => 'admin_index_',
            'plan_params' => $plan_params,
            'months_limit' => $months_limit,
            'user_plan_limit' => $user_plan->expiry_at,
            'latestApp' => $latestApp
            ]
        );

    }
}
