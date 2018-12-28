<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class SendUsEmailController extends Controller
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | SendUsEmail',
            'description' => 'Speed VPN | SendUsEmail',
            'keywords' => 'Speed VPN | SendUsEmail'
        ];

        return view('site.send-us-an-email', $data);
    }
}
