<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class ChangePasswordController extends Controller
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | ChangePassword',
            'description' => 'Speed VPN | ChangePassword',
            'keywords' => 'Speed VPN | ChangePassword'
        ];

        return view('site.change-password', $data);
    }
}
