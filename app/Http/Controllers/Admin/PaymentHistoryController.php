<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class PaymentHistoryController extends AdminController
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | PaymentHistory',
            'description' => 'Speed VPN | PaymentHistory',
            'keywords' => 'Speed VPN | PaymentHistory'
        ];

        return view('admin.payment-history', $data);
    }
}
