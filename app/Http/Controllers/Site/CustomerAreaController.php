<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CustomerAreaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | CustomerArea',
            'description' => 'Speed VPN | CustomerArea',
            'keywords' => 'Speed VPN | CustomerArea'
        ];

        return view('site.customer-area', $data);
    }
}
