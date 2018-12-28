<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Client;
use PHPUnit\Framework\TestCase;


class PageController extends Controller
{

    protected $keywords;
    protected $meta_desc;
    protected $title;

    public function index()
    {

       return view ('index');

    }

    public function cancel()
    {
       return view ('cancel');
    }

    public function contact_us()
    {
       return view ('contact-us');
    }

    public function customer_area()
    {
       return view ('customer-area');
    }

    public function change_password()
    {
      return view ('change-password');

    }

    public function download()
    {
       return view ('download');
    }

    public function how_it_works()
    {
       return view ('how-it-works');
    }

    public function invites()
    {
       return view ('invites');
    }

    public function login()
    {
       return view ('login');
    }

    public function new_password()
    {
       return view ('new-password');
    }

    public function order_details()
    {
       return view ('order-details');
    }

    public function payment_history()
    {
       return view ('payment-history');
    }

    public function plans()
    {
       return view ('plans');
    }

    public function send_us_an_email()
    {
       return view ('send-us-an-email');
    }











}
