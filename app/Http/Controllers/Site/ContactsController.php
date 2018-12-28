<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | Contacts',
            'description' => 'Speed VPN | Contacts',
            'keywords' => 'Speed VPN | Contacts'
        ];

        return view('site.contact-us', $data);
    }
}
