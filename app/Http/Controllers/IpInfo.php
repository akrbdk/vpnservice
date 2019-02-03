<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Os;

class ipinfo extends Controller
{
  public $ip;
  public $ipinfo_data;

  public static function ip_info() {

      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
       $ip = $_SERVER['HTTP_CLIENT_IP'];
      } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
       $ip = $_SERVER['REMOTE_ADDR'];
      }

      $browser = new Browser();
      $os = new Os();

      $ipinfo_data = json_decode(file_get_contents('https://www.iplocate.io/api/lookup/'.$ip), true);
      $ipinfo_data['os'] = $os->getName().' '.$os->getVersion();
      $ipinfo_data['browser'] = $browser->getName();

      return $ipinfo_data;
  }
}
