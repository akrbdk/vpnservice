<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class HowItWorksController extends Controller
{
    public function index()
    {
        parent::__construct();
        return view('site.how-it-works', ['page_key' => 'about_']);
    }
}
