<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class DownloadController extends Controller
{
    public function index()
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
