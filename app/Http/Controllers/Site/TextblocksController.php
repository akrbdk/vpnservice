<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Textblocks;
use Session;
use Config;


class TextblocksController extends Controller
{

    public static function getTextBlock($code = '')
    {
        $locale = Session::get('locale');
        if(empty($code) || !in_array($locale, Config::get('app.locales'))) return false;
        $textblock = Textblocks::where('code', $code)->first()->toArray();
        $data = (isset($textblock['text_' . $locale]) && !empty($textblock['text_' . $locale])) ? $textblock['text_' . $locale] : '';

        return $data;
    }
}
