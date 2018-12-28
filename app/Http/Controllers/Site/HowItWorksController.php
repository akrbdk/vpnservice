<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class HowItWorksController extends Controller
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | HowItWorks',
            'description' => 'Speed VPN | HowItWorks',
            'keywords' => 'Speed VPN | HowItWorks'
        ];

        return view('site.how-it-works', $data);
    }
}
