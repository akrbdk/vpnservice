<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    public function index()
    {
        parent::__construct();

        return view('site.contact-us', ['page_key' => 'contacts_']);
    }
}
