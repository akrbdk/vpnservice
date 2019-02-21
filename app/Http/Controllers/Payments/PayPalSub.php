<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Exception\PayPalConnectionException;

use PayPal\Api\Agreement;
use PayPal\Api\Payer;

use URL;
use Session;
use DB;

class PayPalSub extends Controller
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

    public function subscribe(){
      $plan_id = $_POST['plan_id'];
      $expire = isset($_POST['expire']) ? $_POST['expire'] : time() + 120;

      $plan = DB::table('plans_table')->where('id', $plan_id)->first();
      $plan_name = $plan->plan_name;

      Session::put('plan_id', $plan_id);
      Session::put('price', $plan->price);
      Session::put('months_limit', $plan->months_limit);

      $month = $plan->months_limit/60/60/24/30;
      $price = $plan->price/100;

      // Create a new billing plan
      $plan = new Plan();
      $plan->setName($plan_name)
          ->setDescription('Autopay')
          ->setType('INFINITE');

      // Set billing plan definitions
      $paymentDefinition = new PaymentDefinition();
      $paymentDefinition->setName('Regular Payments')
          ->setType('REGULAR')
          ->setFrequency('Month')
          ->setFrequencyInterval($month)
          ->setCycles('0')
          ->setAmount(new Currency(array(
          'value' => $price * $month, //price all month
          'currency' => 'USD'
      )));

      // Set merchant preferences
      $merchantPreferences = new MerchantPreferences();
      $merchantPreferences->setReturnUrl(URL::to('/substatus'))
          ->setCancelUrl(URL::to('/substatus'))
          ->setAutoBillAmount('yes')
          ->setInitialFailAmountAction('CONTINUE')
          ->setMaxFailAttempts('0')
      ;

      $plan->setPaymentDefinitions(array(
          $paymentDefinition
      ));
      $plan->setMerchantPreferences($merchantPreferences);

      try {
          $createdPlan = $plan->create($this->_api_context);

          try {
              $patch = new Patch();
              $value = new PayPalModel('{"state":"ACTIVE"}');
              $patch->setOp('replace')
                  ->setPath('/')
                  ->setValue($value);
              $patchRequest = new PatchRequest();
              $patchRequest->addPatch($patch);
              $createdPlan->update($patchRequest, $this->_api_context);
              $patchedPlan = Plan::get($createdPlan->getId(), $this->_api_context);

              // Create new agreement
              $startDate = date('c', $expire);
              $agreement = new Agreement();
              $agreement->setName($plan_name) //name
                  ->setDescription('Autopay to '.$plan_name) //description on pay
                  ->setStartDate($startDate);

              // Set plan id
              $plan = new Plan();
              $plan->setId($patchedPlan->getId());
              $agreement->setPlan($plan);

              // Add payer type
              $payer = new Payer();
              $payer->setPaymentMethod('paypal');
              $agreement->setPayer($payer);

              try {
                  // Create agreement
                  $agreement = $agreement->create($this->_api_context);

                  // Extract approval URL to redirect user
                  $approvalUrl = $agreement->getApprovalLink();

                  header("Location: " . $approvalUrl);
                  exit();
              } catch (PayPalConnectionException $ex) {
                  return Redirect::to('/plans')->with('alert', trans('payment_err.autopay_err'));
                  die($ex);
              } catch (Exception $ex) {
                  return Redirect::to('/plans')->with('alert', trans('payment_err.autopay_err'));
                  die($ex);
              }
          } catch (PayPalConnectionException $ex) {
              return Redirect::to('/plans')->with('alert', trans('payment_err.autopay_err'));
              die($ex);
          } catch (Exception $ex) {
              return Redirect::to('/plans')->with('alert', trans('payment_err.autopay_err'));
              die($ex);
          }
      } catch (PayPalConnectionException $ex) {
          return Redirect::to('/plans')->with('alert', trans('payment_err.autopay_err'));
          die($ex);
      } catch (Exception $ex) {
          return Redirect::to('/plans')->with('alert', trans('payment_err.autopay_err'));
          die($ex);
      }
    }
}
