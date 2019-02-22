<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class InvitesController extends Controller
{
    public function index()
    {
        return view('admin.invites', ['page_key' => 'invites_']);
    }
}
