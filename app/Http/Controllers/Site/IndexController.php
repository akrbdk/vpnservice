<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN',
            'description' => 'Speed VPN - самая лучшая компания в своём роде',
            'keywords' => 'Speed VPN - самая лучшая компания в своём роде'
        ];

        return view('site/index', $data);
    }
}
