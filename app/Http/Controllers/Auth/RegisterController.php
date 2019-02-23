<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Notifications\SignupActivate;
use DB;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    public static function create(array $data)
    {
        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $user = DB::table('users')->get()->last();
        $plan = DB::table('plans_table')->first();
        $planInfoArr = [
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'plan_name' => 'Entry',
            'price' => 0,
            'method' => 'Free',
            'auto_renew' => 0,
            'expiry_at' => time(),
            'autopay_id' => null
        ];

        DB::table('payment_history')->insert($planInfoArr);
        return $newUser;
    }
}
