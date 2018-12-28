<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class CancelController extends Controller
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | Cancel',
            'description' => 'Speed VPN | Cancel',
            'keywords' => 'Speed VPN | Cancel'
        ];

        return view('site.cancel', $data);
    }
}
