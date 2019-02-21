<?php
namespace App\Http\Controllers\Payments;

use Illuminate\Support\Facades\Auth;
use Redirect;
use DB;

class BitPayController {
    private function createClient() {
        $password = env('BITPAY_PASSWORD');
        $key = env('BITPAY_KEY');
        $crt = env('BITPAY_CRT');
        $envToken = env('BITPAY_TOKEN');

        // See 002.php for explanation
        $storageEngine = new \Bitpay\Storage\EncryptedFilesystemStorage($password); // Password may need to be updated if you changed it
        $privateKey    = $storageEngine->load($key);
        $publicKey     = $storageEngine->load($crt);
        $client        = new \Bitpay\Client\Client();
        $network       = new \Bitpay\Network\Testnet();
        //$network       = new \Bitpay\Network\Livenet();
        $adapter       = new \Bitpay\Client\Adapter\CurlAdapter();
        $client->setPrivateKey($privateKey);
        $client->setPublicKey($publicKey);
        $client->setNetwork($network);
        $client->setAdapter($adapter);

        $token = new \Bitpay\Token();
        $token->setToken($envToken);

        $client->setToken($token);

        return $client;
    }

    private function setBuyer($invoice, $email) {
        $buyer = new \Bitpay\Buyer();
        $buyer->setEmail($email);
        $invoice->setBuyer($buyer);
    }

    private function setGoodsInfo($invoice, $id, $name, $price) {
        $item = new \Bitpay\Item();
        $item
            ->setCode($id)
            ->setDescription($name)
            ->setPrice($price);
        $invoice->setItem($item);
    }

    private function setCurrency($invoice, $currency) {
        $invoice->setCurrency(new \Bitpay\Currency($currency));
    }

    private function setAdditionalInfo($invoice, $userId, $planId) {
        $invoice
            ->setOrderId($userId . ',' . $planId)
            // You will receive IPN's at this URL, should be HTTPS for security purposes!
            ->setNotificationUrl(url('/bitpaystatus'))
            ->setRedirectUrl(url('/admin'));
    }

	public function index() {
    	$plan_id = $_POST['plan_id'];
        $email = '';

        if(isset($_POST['password'])) {
            $email = $_POST['email'];

            if(!empty(DB::table('users')->where('email', $email)->first())){
              return Redirect::to('/plans')->with('alert', trans('payment_err.email'));
            }
            $pass = $_POST['password'];

            $register = array(
              'name' => 'Not Set',
              'email' => $email,
              'password' => $pass
            );

            RegisterController::create($register);

            Auth::attempt(['email' => $email, 'password' => $pass]);
        }

        $plan = DB::table('plans_table')->where('id', $plan_id)->first();
        $user = DB::table('users')->where('id', Auth::id())->first();

        $invoice = new \Bitpay\Invoice();
        $this->setBuyer($invoice, $user->email);
        $this->setGoodsInfo($invoice, $plan->id, $plan->plan_name, $plan->price/100);
        $this->setCurrency($invoice, 'USD');
        $this->setAdditionalInfo($invoice, Auth::id(), $plan->id);

        $client = $this->createClient();
        $client->createInvoice($invoice);


        $url = $invoice->getUrl();
        return Redirect::away($url);
    }
}
