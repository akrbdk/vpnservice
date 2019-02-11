<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Item;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use App\Http\Controllers\Plans\PlanOrder;
use Redirect;
use Session;

class PayPalStatus extends Controller
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

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        $Order = array(
          'plan_id' => Session::get('plan_id'),
          'months_limit' => Session::get('months_limit'),
          'email' => Session::get('email')
        );

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        Session::forget('plan_id');
        Session::forget('months_limit');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
             return Redirect::to('/plans')->with('alert', 'error: Payment failed!');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            PlanOrder::planOrder($Order);
            return Redirect::to('/plans')->with('alert-success', 'success: Subscribtion success!');
        }
        return Redirect::to('/plans')->with('alert', 'error: Payment failed!');
    }
}
