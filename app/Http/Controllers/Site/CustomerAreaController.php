<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class CustomerAreaController extends Controller
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | CustomerArea',
            'description' => 'Speed VPN | CustomerArea',
            'keywords' => 'Speed VPN | CustomerArea'
        ];

        return view('site.customer-area', $data);
    }
}
