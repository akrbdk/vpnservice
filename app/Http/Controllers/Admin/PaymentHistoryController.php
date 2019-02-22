<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PaymentHistoryController extends Controller
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
        return view('admin.payment-history', ['page_key' => 'history_']);
    }
}
