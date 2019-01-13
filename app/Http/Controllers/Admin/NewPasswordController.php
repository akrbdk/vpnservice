<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class NewPasswordController extends AdminController
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | NewPassword',
            'description' => 'Speed VPN | NewPassword',
            'keywords' => 'Speed VPN | NewPassword'
        ];

        return view('admin.new-password', $data);
    }
}
