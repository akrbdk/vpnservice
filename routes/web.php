<?php

Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, Config::get('app.locales'))) session(['locale' => $locale]);
    return redirect()->back();
})->name('setlocale');

//Роуты витрины сайта
Route::namespace('Site')->group(function(){
    Route::get('/', 'IndexController@index');
    Route::get('/home', 'IndexController@index');
    Route::get('/cancel', 'CancelController@index');
    Route::get('/contact-us', 'ContactsController@index');
    Route::get('/plans', 'PlansController@index');
    Route::get('/download', function () {
        $model = App\AppsInfo::firstOrFail();
        return redirect('download/' . $model->link);
    });
    Route::get('/download/{alias}', 'AppsInfoController@index');
    Route::get('/send-us-an-email', 'SendUsEmailController@index');
    Route::get('/how-it-works', 'HowItWorksController@index');
});

//Ajax маршруты
Route::post('/sendmail', ['as'=>'contactus.store','uses'=>'Ajax\ContactController@send']);
Route::post('/plan', 'Plans\PlanOrder@planOrder');

// Маршруты аутентификации и регистрации
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Роуты админки
Route::middleware('auth')->prefix('/admin')->group(function(){
    //main user info
    Route::get('/', 'Admin\AdminControllerMain@index');

    //logout
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/logout', 'Auth\LoginController@logout');

    //admin buy plan
    Route::get('/customer-area', 'Admin\CustomerAreaController@index');

    // change user password
    Route::get('/change-password', 'Admin\ChangePasswordController@index');

    // change user password
    Route::post('/new-password', 'Admin\ChangePasswordController@updatePassword');

    //plan details
    Route::get('/order-details', 'Admin\OrderDetailsController@index');

    //history payments
    Route::get('/payment-history', 'Admin\PaymentHistoryController@index');

    //invite your friend
    Route::get('/invites', 'Admin\InvitesController@index');
});

//POST запрос для отправки email письма пользователю для сброса пароля
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//ссылка для сброса пароля (можно размещать в письме)
Route::get('password/reset', 'Auth\ResetPasswordController@showLinkRequestForm')->name('password.request');
//страница с формой для сброса пароля
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//POST запрос для сброса старого и установки нового пароля
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//внедрил роут для быстрой чистки кэша приложения
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
});


//роут для доступа к приватным файлам по прямой ссылке
Route::get('storage/upload/{filename}', function ($filename){
    $path = storage_path('upload/' . $filename);
    if(Admin::user() && File::exists($path)){
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
    abort(404);
});
