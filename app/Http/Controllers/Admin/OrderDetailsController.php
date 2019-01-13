<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class OrderDetailsController extends AdminController
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | OrderDetails',
            'description' => 'Speed VPN | OrderDetails',
            'keywords' => 'Speed VPN | OrderDetails'
        ];

        return view('admin.order-details', $data);
    }
}
