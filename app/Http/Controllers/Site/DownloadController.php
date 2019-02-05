<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class DownloadController extends Controller
{
    public function index()
    {
        parent::__construct();
        return view('site.download', ['page_key' => 'download_']);
    }
}
