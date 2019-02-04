<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;


class AdminControllerMain extends AdminController
{

    /**
     * Create a new controller instance.
     *
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
        return view('admin.index', ['page_key' => 'admin_index_']);
    }
}
