<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Agreement;
use PayPal\Exception\PayPalConnectionException;

use Session;
use Redirect;
use DB;
use Auth;

class SubRedirect extends Controller
{

  private $_api_context;
  /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct()
   {
       /** PayPal api context **/
       $paypal_conf = \Config::get('paypal');
       $this->_api_context = new ApiContext(new OAuthTokenCredential(
           $paypal_conf['client_id'],
           $paypal_conf['secret'])
       );
       $this->_api_context->setConfig($paypal_conf['settings']);
   }
   public function index()
   {
         $token = $_GET['token'];
         $user_id = Auth::id();
         $pay_id = Session::get('get_id');

         $agreement = new Agreement();
           try {
             // Execute agreement

             $exec = $agreement->execute($token, $this->_api_context);
             $autopay_id = $exec->id;
             DB::table('payment_history')->where('id', $pay_id)->update(array('auto_renew' => '1', 'autopay_id' => $autopay_id));
             return Redirect::to('/admin')->with('alert-success', trans('payment_err.autopay'));
         } catch (PayPalConnectionException $ex) {
             return Redirect::to('/plans')->with('alert', trans('payment_err.autopay_err'));
             die($ex);
         } catch (Exception $ex) {
             return Redirect::to('/plans')->with('alert', trans('payment_err.autopay_err'));
         }
    }
}
