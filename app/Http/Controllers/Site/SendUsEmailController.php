<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class SendUsEmailController extends Controller
{
    public function index()
    {
        return view('site.send-us-an-email', ['page_key' => 'send_email_']);
    }
}
