<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class AppsInfoController extends Controller
{
    public function index($alias)
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | Download',
            'description' => 'Speed VPN | Download',
            'keywords' => 'Speed VPN | Download'
        ];

        return view('site.download', $data);
    }
}
