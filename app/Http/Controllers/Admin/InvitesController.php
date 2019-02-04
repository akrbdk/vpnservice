<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

class InvitesController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.invites', ['page_key' => 'invites_']);
    }
}
