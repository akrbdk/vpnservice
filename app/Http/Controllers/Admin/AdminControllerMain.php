<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class AdminControllerMain extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | CustomerArea',
            'description' => 'Speed VPN | CustomerArea',
            'keywords' => 'Speed VPN | CustomerArea'
        ];

        return view('admin.customer-area', $data);
    }
}
