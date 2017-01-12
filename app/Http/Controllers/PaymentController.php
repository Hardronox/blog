<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\FundingInstrument;
use PayPal\Api\InputFields;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\PayerInfo;
use PayPal\Api\Payment;
use PayPal\Api\PaymentCard;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ShippingAddress;
use PayPal\Api\Transaction;
use PayPal\Api\WebProfile;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;



class PaymentController extends Controller
{
    public function paypal()
    {
        define('SITE_URL', 'http://localhost:8000/');
        $paypal = new ApiContext(new OAuthTokenCredential(
            'AZxoAZkS8ArNrjQO_8Od8Nzfi7kLn0eWM80eO6taCWI4NFpEFBHRD0mJ5URRnGIqgH8FR-yhnakpCxMB',
            'EFCPnVKwSXKGU7dUNFV9mWzgBYqIBwc3Vi8uy6injMXvsXwzcpXCNCjpWjsFoAWmWwwOuroPM2K13zsg'));

        $product = "subscribe";
        $price = 10;
        $total = $price;


        $payer = new Payer();
        $payer->setPaymentMethod('paypal');


        $item = new Item();
        $item->setName($product)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setSubtotal($price);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('PayForSmth')
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(SITE_URL.'payment/success')
            ->setCancelUrl(SITE_URL . 'site/pay?success=false');

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);
        try {
            $payment->create($paypal);
        } catch (\Exception $e) {
            die($e);
        }
        $approvalUrl = $payment->getApprovalLink();
        return redirect($approvalUrl);
    }

    public function card()
    {

        Stripe::setApiKey(config('services.stripe.secret'));



        $customer= Customer::create([
            'email'=>request('stripeEmail'),
            'source'=>request('stripeToken')

        ]);

        Charge::create([
           'customer'=>$customer->id,
            'amount'=>2500,
            'currency'=>'usd'
        ]);

        return "all done";
//        $paypal = new ApiContext(new OAuthTokenCredential(
//            'AZxoAZkS8ArNrjQO_8Od8Nzfi7kLn0eWM80eO6taCWI4NFpEFBHRD0mJ5URRnGIqgH8FR-yhnakpCxMB',
//            'EFCPnVKwSXKGU7dUNFV9mWzgBYqIBwc3Vi8uy6injMXvsXwzcpXCNCjpWjsFoAWmWwwOuroPM2K13zsg'));
//
//        // ### PaymentCard
//// A resource representing a payment card that can be
//// used to fund a payment.
//        $card = new PaymentCard();
//        $card->setType("visa")
//            ->setNumber("4024007123477282")
//            ->setExpireMonth("11")
//            ->setExpireYear("2019")
//            ->setCvv2("012")
//            ->setFirstName("Joe")
//            ->setBillingCountry("US")
//            ->setLastName("Shopper");
//// ### FundingInstrument
//// A resource representing a Payer's funding instrument.
//// For direct credit card payments, set the CreditCard
//// field on this object.
//        $fi = new FundingInstrument();
//        $fi->setPaymentCard($card);
//// ### Payer
//// A resource representing a Payer that funds a payment
//// For direct credit card payments, set payment method
//// to 'credit_card' and add an array of funding instruments.
//        $payer = new Payer();
//        $payer->setPaymentMethod("credit_card")
//            ->setFundingInstruments(array($fi));
//// ### Itemized information
//// (Optional) Lets you specify item wise
//// information
//        $item1 = new Item();
//        $item1->setName('Ground Coffee 40 oz')
//            ->setDescription('Ground Coffee 40 oz')
//            ->setCurrency('USD')
//            ->setQuantity(1)
//            ->setPrice(10);
//
//        $itemList = new ItemList();
//        $itemList->setItems([$item1]);
//// ### Additional payment details
//// Use this optional field to set additional
//// payment information such as tax, shipping
//// charges etc.
//        $details = new Details();
//        $details->setSubtotal(10);
//// ### Amount
//// Lets you specify a payment amount.
//// You can also specify additional details
//// such as shipping, tax.
//        $amount = new Amount();
//        $amount->setCurrency("USD")
//            ->setTotal(10)
//            ->setDetails($details);
//// ### Transaction
//// A transaction defines the contract of a
//// payment - what is the payment for and who
//// is fulfilling it.
//        $transaction = new Transaction();
//        $transaction->setAmount($amount)
//            ->setItemList($itemList)
//            ->setDescription("Payment description")
//            ->setInvoiceNumber(uniqid());
//// ### Payment
//// A Payment Resource; create one using
//// the above types and intent set to sale 'sale'
//        $payment = new Payment();
//        $payment->setIntent("sale")
//            ->setPayer($payer)
//            ->setTransactions(array($transaction));
//// For Sample Purposes Only.
//        $request = clone $payment;
//// ### Create Payment
//// Create a payment by calling the payment->create() method
//// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
//// The return object contains the state.
//        try {
//            $payment->create($paypal);
//        } catch (PayPalConnectionException $ex) {
//            var_dump(json_decode($ex->getData()));
//            exit(1);
//        }
// NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
        //\ResultPrinter::printResult('Create Payment Using Credit Card', 'Payment', $payment->getId(), $request, $payment);
        //return $payment;
    }


    public function successPayment(Request $request)
    {
        $article_id = $request->session()->get('article_id');

        $user = Auth::user();

        if(!$user->hasRole('subscriber'))
        {
            $user->roles()->attach(2);
        }
        else
            return redirect("/blog/$article_id");


        $article=Articles::find(intval($article_id));

        return view('site.success-payment', ['article'=>$article]);
    }
}