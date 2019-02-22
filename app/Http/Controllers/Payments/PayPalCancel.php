<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Agreement;
use PayPal\Api\AgreementStateDescriptor;

use Auth;
use Redirect;
use DB;

class PayPalCancel
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

    public function index($autopay_id)
        {
            $agreement = new Agreement();

            $agreement->setId($autopay_id);
            $agreementStateDescriptor = new AgreementStateDescriptor();
            $agreementStateDescriptor->setNote("Cancel the agreement");

            try {
                $agreement->cancel($agreementStateDescriptor, $this->_api_context);
                $cancelAgreementDetails = Agreement::get($agreement->getId(), $this->_api_context);
                DB::table('payment_history')->where('autopay_id', $autopay_id)->update(array('auto_renew' => '0', 'autopay_id' => ''));
                return Redirect::to('/admin/payment-history')->with('alert', trans('payment_err.cancel_success'));
            } catch (Exception $ex) {
              return Redirect::to('/admin/payment-history')->with('alert', trans('payment_err.cancel_err'));
            }
        }
}
