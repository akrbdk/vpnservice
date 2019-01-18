<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class PaymentHistoryController extends Controller
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | PaymentHistory',
            'description' => 'Speed VPN | PaymentHistory',
            'keywords' => 'Speed VPN | PaymentHistory'
        ];

        return view('site.payment-history', $data);
    }
}
