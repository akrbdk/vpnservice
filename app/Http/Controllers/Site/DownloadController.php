<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class DownloadController extends Controller
{
    public function index()
    {
        return view('site.download', ['page_key' => 'download_']);
    }
}
