<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class OrderDetailsController extends AdminController
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

    public function index()
    {

        $data = [
            'title' => 'Speed VPN | OrderDetails',
            'description' => 'Speed VPN | OrderDetails',
            'keywords' => 'Speed VPN | OrderDetails'
        ];

        return view('admin.order-details', $data);
    }
}
