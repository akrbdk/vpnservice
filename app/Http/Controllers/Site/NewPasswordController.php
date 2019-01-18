<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class NewPasswordController extends Controller
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | NewPassword',
            'description' => 'Speed VPN | NewPassword',
            'keywords' => 'Speed VPN | NewPassword'
        ];

        return view('site.new-password', $data);
    }
}
