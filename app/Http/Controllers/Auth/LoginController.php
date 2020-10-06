<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';
    
    public function __construct() {
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    public function showLoginForm() {
        return view('auth.login');
    }
}
