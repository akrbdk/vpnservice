<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class PlansController extends Controller
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | Plans',
            'description' => 'Speed VPN | Plans',
            'keywords' => 'Speed VPN | Plans'
        ];

        return view('site.plans', $data);
    }
}
