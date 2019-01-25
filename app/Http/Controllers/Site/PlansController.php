<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\PlansTable;

class PlansController extends Controller
{
    public function index()
    {
        parent::__construct();



        $data = [
            'title' => 'Speed VPN | Plans',
            'description' => 'Speed VPN | Plans',
            'keywords' => 'Speed VPN | Plans'
        ];

        return view('site.plans', $data);
    }

    public static function showPlans()
    {
        $allPlans = PlansTable::all();

        $data = [
            'title' => 'Speed VPN | Plans',
            'description' => 'Speed VPN | Plans',
            'keywords' => 'Speed VPN | Plans',
            'plans' => $allPlans
        ];

        return $data;
    }
}
