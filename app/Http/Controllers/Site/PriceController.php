<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Request;

class PriceController extends Controller
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Цены',
            'description' => 'Цены на наши услуги'
        ];

        $data['breadcrumbs'] = Request::get('breadcrumbs');

        return view('site.pricingbox', $data);
    }
}
