<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Agreement;
use PayPal\Api\AgreementStateDescriptor;

use Auth;
use Redirect;
use DB;

class CancelSub extends Controller
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
        $user_id = Auth::id();

        $autopay = DB::table('payment_history')->where('autopay_id', '<>', '')->where('user_id', $user_id)->first();

        if(empty($autopay)){
          return Redirect::to('/admin/payment-history')->with('alert', trans('payment_err.no_sub'));
        }

        $agreementId=$autopay->autopay_id;

        $agreement = new Agreement();

        $agreement->setId($agreementId);
        $agreementStateDescriptor = new AgreementStateDescriptor();
        $agreementStateDescriptor->setNote("Cancel the agreement");

        try {
            $agreement->cancel($agreementStateDescriptor, $this->_api_context);
            $cancelAgreementDetails = Agreement::get($agreement->getId(), $this->_api_context);
            return Redirect::to('/admin/payment-history')->with('alert', trans('payment_err.cancel_success'));
        } catch (Exception $ex) {
          return Redirect::to('/admin/payment-history')->with('alert', trans('payment_err.cancel_err'));
        }
    }
}
