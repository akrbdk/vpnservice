<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class PaymentHistoryController extends AdminController
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

    public function index()
    {

        $data = [
            'title' => 'Speed VPN | PaymentHistory',
            'description' => 'Speed VPN | PaymentHistory',
            'keywords' => 'Speed VPN | PaymentHistory'
        ];

        return view('admin.payment-history', $data);
    }
}
