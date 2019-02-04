<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    public function index()
    {
        parent::__construct();
        return view('site.index', ['page_key' => 'index_']);
    }
}
