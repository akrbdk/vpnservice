<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Auth;
use DB;
use App\User;

class AdminControllerMain extends AdminController
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $user_plan = DB::table('users_plans')->where('user_id', $user_id)->first();
        $plan_params = DB::table('plans_table')->where('id', $user_plan->plan_id)->first();
        $months_limit = time() + (int)$plan_params->months_limit;

        return view('admin.index', ['page_key' => 'admin_index_', 'plan_params' => $plan_params, 'months_limit' => $months_limit]);

    }
}
