<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class ChangePasswordController extends AdminController
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | ChangePassword',
            'description' => 'Speed VPN | ChangePassword',
            'keywords' => 'Speed VPN | ChangePassword'
        ];

        return view('admin.change-password', $data);
    }
}
