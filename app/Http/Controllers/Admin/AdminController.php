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

        $data = [
            'title' => 'Speed VPN | Admin Panel',
            'description' => 'Speed VPN | Admin Panel',
            'keywords' => 'Speed VPN | Admin Panel'
        ];

        return view('admin.index', $data);

    }
}
