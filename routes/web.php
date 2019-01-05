<?php

use App\Http\Controllers\PageController;

Route::get('setlocale/{locale}', function ($locale) {

    if (in_array($locale, Config::get('app.locales'))) {
        session(['locale' => $locale]);
    }
    return redirect()->back();

})->name('setlocale');

//Роуты витрины сайта
Route::namespace('Site')->group(function(){
    Route::get('/', 'IndexController@index');
    Route::get('/home', 'IndexController@index');
    Route::get('/cancel', 'CancelController@index');
    Route::get('/contact-us', 'ContactsController@index');
    Route::get('/plans', 'PlansController@index');
    Route::get('/download', 'DownloadController@index');
    Route::get('/send-us-an-email', 'SendUsEmailController@index');
    Route::get('/invites', 'InvitesController@index');
    Route::get('/how-it-works', 'HowItWorksController@index');

    Route::get('/customer-area', 'CustomerAreaController@index');
    Route::get('/change-password', 'ChangePasswordController@index');
    Route::get('/new-password', 'NewPasswordController@index');
    Route::get('/order-details', 'OrderDetailsController@index');
    Route::get('/payment-history', 'PaymentHistoryController@index');

    //Ajax маршруты
    Route::post('/sendmail', 'Ajax\AjaxController@send');
});

// Маршруты аутентификации и регистрации
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('logout', 'Auth\LoginController@logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


//Роуты админки
Route::namespace('Admin')->group(function(){
    Route::get('/admin', 'AdminController@index');
});

/**
 * URL для сброса пароля...
 */
//POST запрос для отправки email письма пользователю для сброса пароля
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//ссылка для сброса пароля (можно размещать в письме)
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//страница с формой для сброса пароля
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//POST запрос для сброса старого и установки нового пароля
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::get('recaptchacreate', 'RecaptchaController@create');
Route::post('store', 'RecaptchaController@store');
