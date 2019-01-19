<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App;
use Session;
use Cookie;
use Request;
use Config;

class AdminController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        if(empty(Session::get('locale'))){
            $browser_lang = substr(Request::server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            $locale = (!empty($browser_lang) && in_array($browser_lang, Config::get('app.locales'))) ? $browser_lang : Config::get('app.locale');

            session(['locale' => $locale]);
        }

        App::setLocale(Session::get('locale'));
    }
}
