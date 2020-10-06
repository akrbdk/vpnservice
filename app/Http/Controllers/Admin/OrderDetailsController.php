<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class OrderDetailsController extends Controller
{
    public function index()
    {
        return view('admin.order-details', ['page_key' => 'order_']);
    }
}
