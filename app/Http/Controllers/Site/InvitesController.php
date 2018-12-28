<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class InvitesController extends Controller
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | Invites',
            'description' => 'Speed VPN | Invites',
            'keywords' => 'Speed VPN | Invites'
        ];

        return view('site.invites', $data);
    }
}
