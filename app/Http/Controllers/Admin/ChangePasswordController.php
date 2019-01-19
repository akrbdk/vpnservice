<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\User;

class ChangePasswordController extends AdminController
{
    public function index()
    {
        parent::__construct();

        $data = [
            'title' => 'Speed VPN | ChangePassword',
            'description' => 'Speed VPN | ChangePassword',
            'keywords' => 'Speed VPN | ChangePassword'
        ];

        return view('admin.change-password', $data);
    }

    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => 'required|min:6',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
        ],[
            'current_password.required' => 'Old password is required',
            'current_password.min' => 'Old password needs to have at least 6 characters',
            'password.required' => 'Password is required',
            'password.min' => 'Password needs to have at least 6 characters',
            'password_confirmation.required' => 'Passwords do not match'
        ]);

        $current_password = \Auth::User()->password;
        if(\Hash::check($request->input('current_password'), $current_password))
        {
            $user_id = \Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = \Hash::make($request->input('password'));
            $obj_user->save();
            return redirect('/admin/');
        }
        else
        {
            $data['current_password'] = 'Please enter correct current password';
            return Redirect::back()->withErrors($data);
        }
    }
}
