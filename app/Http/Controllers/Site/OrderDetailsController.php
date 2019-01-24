<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class OrderDetailsController extends Controller
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | OrderDetails',
            'description' => 'Speed VPN | OrderDetails',
            'keywords' => 'Speed VPN | OrderDetails'
        ];

        return view('site.order-details', $data);
    }
}
