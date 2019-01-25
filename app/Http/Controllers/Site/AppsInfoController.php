<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\AppsInfo;

class AppsInfoController extends Controller
{
    public function index($alias)
    {
        parent::__construct();
        $tabInfo= AppsInfo::where('link', $alias)->firstOrFail();
        $allTabs = AppsInfo::all();

        return view('site.download',
            [
                'title' => 'Speed VPN | Download',
                'description' => 'Speed VPN | Download',
                'keywords' => 'Speed VPN | Download',
                'tabInfo' => $tabInfo,
                'allTabs' => $allTabs,
            ]);
    }
}
