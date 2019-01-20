<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

//    public function showResetForm(Request $request, $token = null){
//        $request = $request->all();
//        return view('admin.change-password')->with(
//            [
//                'title' => 'Speed VPN | ChangePassword',
//                'description' => 'Speed VPN | ChangePassword',
//                'keywords' => 'Speed VPN | ChangePassword',
//                'token' => $token,
//                'email' => $request
//            ]
//        );
//    }
}
