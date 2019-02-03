<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\IpInfo as IpInfo;
use GuzzleHttp\Client;
use App;
use DB;
use Session;
use Cookie;
use Request;
use Config;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $ip_info;
    public $protect_status;
    public $protect_status1;

    public function __construct()
    {
        if(empty(Session::get('locale'))){
            $browser_lang = substr(Request::server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
            $locale = (!empty($browser_lang) && in_array($browser_lang, Config::get('app.locales'))) ? $browser_lang : Config::get('app.locale');

            session(['locale' => $locale]);
        }
        App::setLocale(Session::get('locale'));

        $this->middleware(function ($request, $next) {

            $ip_info = IpInfo::ip_info();

            $serverInfo = DB::table('server_infos')->where('ip', trim($ip_info['ip']))->first();

            $this->protect_status = !empty($serverInfo) ? true : false;

            view()->share('protect_status', $this->protect_status);
            view()->share('ip_info', $ip_info);

            return $next($request);
        });
    }
}
