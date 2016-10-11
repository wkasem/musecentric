<?php namespace App\Payments;

use Paypal;
use App\Payment;

class Paypal
{

  private $_apiContext;

  public function __construct()
  {
      $this->_apiContext = PayPal::ApiContext(
          env('PAYPAL_CLIENT_ID'),
          env('PAYPAL_CLIENT_SECRET'));

      $this->_apiContext->setConfig(array(
          'mode' => 'live',
          'http.ConnectionTimeOut' => 30
        ));

  }


  public function getCheckout()
  {
      $payer = PayPal::Payer();
      $payer->setPaymentMethod('paypal');

      $amount = PayPal::Amount();
      $amount->setCurrency('USD');
      $amount->setTotal(99.99);

      $transaction = PayPal::Transaction();
      $transaction->setAmount($amount);
      $transaction->setDescription('Musecentric Monthly Fee');

      $redirectUrls = PayPal:: RedirectUrls();
      $redirectUrls->setReturnUrl(route('user.settings'));
      $redirectUrls->setCancelUrl(route('user.settings'));

      $payment = PayPal::Payment();
      $payment->setIntent('sale');
      $payment->setPayer($payer);
      $payment->setRedirectUrls($redirectUrls);
      $payment->setTransactions(array($transaction));

      $response = $payment->create($this->_apiContext);
      $redirectUrl = $response->links[1]->href;

      return redirect()->away( $redirectUrl );
  }

  public function getDone(Request $request)
  {
      $id = $request->get('paymentId');
      $token = $request->get('token');
      $payer_id = $request->get('PayerID');

      $payment = PayPal::getById($id, $this->_apiContext);

      $paymentExecution = PayPal::PaymentExecution();

      $paymentExecution->setPayerId($payer_id);
      $executePayment = $payment->execute($paymentExecution, $this->_apiContext);

      Payment::create([
         'payment_id' => $id,
         'user_id'    => auth()->user()->id
      ]);

      auth()->user()->update([
        'subscribed' => 1
      ]);

      return view('home.settings');
  }

  public function getCancel()
  {
      return view('home.settings');
  }
}
