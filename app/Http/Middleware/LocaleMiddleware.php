<?php
namespace App\Http\Middleware;

use Closure;
use App;
use Request;
use Session;
use Config;
use Cookie;

class LocaleMiddleware
{

//    public static $mainLanguage = 'en'; //основной язык, который не должен отображаться в URl
//    public static $languages = ['en', 'br']; // Указываем, какие языки будем использовать в приложении.
//
//
//    /*
//    * Проверяет наличие корректной метки языка в текущем URL
//    * Возвращает метку или значеие null, если нет метки
//    */
//
//    public static function getLocale()
//    {
//        $uri = Request::path(); //получаем URI
//
//
//        $segmentsURI = explode('/',$uri); //делим на части по разделителю "/"
//
//
//        //Проверяем метку языка  - есть ли она среди доступных языков
//        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)) {
//
//            if ($segmentsURI[0] != self::$mainLanguage) return $segmentsURI[0];
//
//        }
//        return null;
//    }
//
//    /*
//    * Устанавливает язык приложения в зависимости от метки языка из URL
//    */
//    public function handle($request, Closure $next)
//    {
//        $locale = self::getLocale();
//
//        if($locale) App::setLocale($locale);
//        //если метки нет - устанавливаем основной язык $mainLanguage
//        else App::setLocale(self::$mainLanguage);
//
//        return $next($request); //пропускаем дальше - передаем в следующий посредник
//    }

    public function handle($request, Closure $next)
    {
        $raw_locale = trim(Session::get('locale'));     # Если пользователь уже был на нашем сайте,
        # то в сессии будет значение выбранного им языка.

        $locale = Config::get('app.locale');

//        if ($raw_locale == 'br'
////            in_array($raw_locale, ['en', 'br'])
//        ) {                                                         # Проверяем, что у пользователя в сессии установлен доступный язык
//            $locale = $raw_locale;                                # (а не какая-нибудь бяка)
//        }                                                        # И присваиваем значение переменной $locale.
                                                                    # В ином случае присваиваем ей язык по умолчанию
//        $locale = (Session::get('locale')) == 'br' ? 'br' : 'en';

//        App::setLocale(Session::get('locale'));                                  # Устанавливаем локаль приложения

        return $next($request);                                   # И позволяем приложению работать дальше
    }
}
