<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class InvitesController extends AdminController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | Invites',
            'description' => 'Speed VPN | Invites',
            'keywords' => 'Speed VPN | Invites'
        ];

        return view('admin.invites', $data);
    }
}
