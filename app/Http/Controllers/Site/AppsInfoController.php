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
                'page_key' => 'apps_info_',
                'tabInfo' => $tabInfo,
                'allTabs' => $allTabs,
            ]);
    }
}
