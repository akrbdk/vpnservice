<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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

    public $user_loc;
    public $user_ip;
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
            $this->user_ip = Request::ip();
            $this->user_loc = self::ip_info($this->user_ip);

            $serverInfo = DB::table('server_infos')->where('ip', trim($this->user_ip))->first();

            $this->protect_status = !empty($serverInfo) ? true : false;

            view()->share('protect_status', $this->protect_status);
            view()->share('user_ip', $this->user_ip);
            view()->share('user_loc', $this->user_loc);

            return $next($request);
        });
    }

    public static function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $remote = sprintf("https://www.iplocate.io/api/lookup/%s", $ip);

        $client = new Client();
        $response = $client->request('GET', $remote);
        return json_decode($response->getBody(), true);
    }
}
