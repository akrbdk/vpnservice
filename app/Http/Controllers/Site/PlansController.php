<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class PlansController extends Controller
{
    public function index()
    {
        return view('site.plans', ['page_key' => 'plans_']);
    }
}
