<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    public function index()
    {
        return view('site.contact-us', ['page_key' => 'contacts_']);
    }
}
