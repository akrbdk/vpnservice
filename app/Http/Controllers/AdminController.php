<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends BaseController
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

        $data = [
            'title' => 'Speed VPN | Admin Panel',
            'description' => 'Speed VPN | Admin Panel',
            'keywords' => 'Speed VPN | Admin Panel'
        ];

        return view('admin.index', $data);

    }
}
