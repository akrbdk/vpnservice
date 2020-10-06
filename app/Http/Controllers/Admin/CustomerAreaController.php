<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CustomerAreaController extends Controller
{
    public function index()
    {
        return view('admin.customer-area', ['page_key' => 'customer_area_']);
    }
}
