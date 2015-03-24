<?php namespace App\Http\Controllers;

use Paypalpayment;
use Redirect;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

	private $_apiContext;

	public function __construct()
	{
		$this->_apiContext = Paypalpayment::ApiContext(config('services.paypal.client_id'), config('services.paypal.secret'));
		
		$this->_apiContext->setConfig(array(
			'mode' => 'sandbox',
			'service.EndPoint' => 'https://api.sandbox.paypal.com',
			'http.ConnectionTimeOut' => 30,
			'log.LogEnabled' => true,
			'log.FileName' => storage_path('logs/paypal.log'),
			'log.LogLevel' => 'FINE'
		));
	}

	public function getDone(Request $request)
	{
		$id = $request->get('paymentId');
		$token = $request->get('token');
		$payer_id = $request->get('PayerID');
		
		$payment = Paypalpayment::getById($id, $this->_apiContext);

		$paymentExecution = Paypalpayment::PaymentExecution();

		$paymentExecution->setPayer_id($payer_id);
		$executePayment = $payment->execute($paymentExecution, $this->_apiContext);
	}
	
	public function getCancel()
	{
		// todo
		return 'Y U DO THIS';
	}

	public function getIndex()
	{
		$payer = Paypalpayment::Payer();
		$payer->setPayment_method("paypal");

		$amount = Paypalpayment:: Amount();
		$amount->setCurrency("USD");
		$amount->setTotal("1.00");

		$transaction = Paypalpayment:: Transaction();
		$transaction->setAmount($amount);
		$transaction->setDescription("This is the payment description.");

		$redirectUrls = Paypalpayment:: RedirectUrls();
		$redirectUrls->setReturn_url(url('/checkout/done'));
		$redirectUrls->setCancel_url(url('/checkout/cancel'));

		$payment = Paypalpayment:: Payment();
		$payment->setIntent("sale");
		$payment->setPayer($payer);
		$payment->setRedirectUrls($redirectUrls);
		$payment->setTransactions(array($transaction));

		$response = $payment->create($this->_apiContext);

		//set the trasaction id , make sure $_paymentId var is set within your class
		$this->_paymentId = $response->id;

		//dump the repose data when create the payment
		$redirectUrl = $response->links[1]->href;

		//this is will take you to complete your payment on paypal
		//when you confirm your payment it will redirect you back to the rturned url set above
		//inmycase sitename/payment/confirmpayment this will execute the getConfirmpayment function bellow
		//the return url will content a PayerID var
		return Redirect::to( $redirectUrl );
	}

}