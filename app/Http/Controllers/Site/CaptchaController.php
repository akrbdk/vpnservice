<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class CaptchaController extends Controller
{
    public function create()
    {
        parent::__construct();

        return view('recaptchacreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        return "success";
    }
}
