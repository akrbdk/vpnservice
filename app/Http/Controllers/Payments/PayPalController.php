<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/

use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

use Redirect;
use Session;
use URL;
use DB;

class PayPalController extends Controller
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

    public function payWithpaypal(Request $request)
    {
        $email = '';
        // register
        if(isset($_POST['password'])){
          $email = $_POST['email'];
          $pass = $_POST['password'];

          $register = array(
            'name' => 'Not Set',
            'email' => $email,
            'password' => $pass
          );

          RegisterController::create($register);
        }

        // Get POST data
        $plan_id = $_POST['plan_id'];

        $plan = DB::table('plans_table')->where('id', $plan_id)->first();

        Session::put('email', $email);
        Session::put('plan_id', $plan_id);
        Session::put('plan_name', $plan->plan_name);
        Session::put('price', $plan->price);
        Session::put('months_limit', $plan->months_limit);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($plan->plan_name) /** item name **/
             ->setCurrency('USD')
             ->setQuantity(1)
             ->setPrice($plan->price/100); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item));

        $amount = new Amount();
        $amount->setCurrency('USD')
               ->setTotal($plan->price/100);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('/paypalstatus')) /** Specify return URL **/
                      ->setCancelUrl(URL::to('/paypalstatus'));

        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                return Redirect::to('/plans')->with('alert', trans('payment_err.timeout'));
            } else {
                return Redirect::to('/plans')->with('alert', trans('payment_err.occur'));
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        return Redirect::to('/plans')->with('alert', trans('payment_err.unknown'));
    }
}
