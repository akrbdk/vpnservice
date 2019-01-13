<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class CustomerAreaController extends AdminController
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