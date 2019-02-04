<?php

namespace App\Http\Controllers;

use App;
use DB;
use Session;
use Cookie;
use Request;
use Config;
class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
    }
}
