<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaymentController extends Controller
{
    private $_apiContext;

    /**
     * Set the ClientId and the ClientSecret.
     * @param
     *string $_ClientId
     *string $_ClientSecret
     */
    private $_ClientId='AZxoAZkS8ArNrjQO_8Od8Nzfi7kLn0eWM80eO6taCWI4NFpEFBHRD0mJ5URRnGIqgH8FR-yhnakpCxMB';
    private $_ClientSecret='EFCPnVKwSXKGU7dUNFV9mWzgBYqIBwc3Vi8uy6injMXvsXwzcpXCNCjpWjsFoAWmWwwOuroPM2K13zsg';

    /*
     *   These construct set the SDK configuration dynamiclly,
     *   If you want to pick your configuration from the sdk_config.ini file
     *   make sure to update you configuration there then grape the credentials using this code :
     *   $this->_cred= Paypalpayment::OAuthTokenCredential();
    */
    public function __construct()
    {

        // ### Api Context
        // Pass in a `ApiContext` object to authenticate
        // the call. You can also send a unique request id
        // (that ensures idempotency). The SDK generates
        // a request id if you do not pass one explicitly.

        //$this->_apiContext = Paypalpayment::apiContext($this->_ClientId, $this->_ClientSecret);

    }

    /*
   * Display form to process payment using credit card
   */
    public function create()
    {
        return View::make('payment.order');
    }

    /*
    * Process payment using credit card
    */
//    public function store()
//    {
//        // ### Address
//        // Base Address object used as shipping or billing
//        // address in a payment. [Optional]
//        $addr= Paypalpayment::address();
//        $addr->setLine1("3909 Witmer Road");
//        $addr->setLine2("Niagara Falls");
//        $addr->setCity("Niagara Falls");
//        $addr->setState("NY");
//        $addr->setPostalCode("14305");
//        $addr->setCountryCode("US");
//        $addr->setPhone("716-298-1822");
//
//        // ### CreditCard
//        $card = Paypalpayment::creditCard();
//        $card->setType("visa")
//            ->setNumber("4758411877817150")
//            ->setExpireMonth("05")
//            ->setExpireYear("2019")
//            ->setCvv2("456")
//            ->setFirstName("Joe")
//            ->setLastName("Shopper");
//
//        // ### FundingInstrument
//        // A resource representing a Payer's funding instrument.
//        // Use a Payer ID (A unique identifier of the payer generated
//        // and provided by the facilitator. This is required when
//        // creating or using a tokenized funding instrument)
//        // and the `CreditCardDetails`
//        $fi = Paypalpayment::fundingInstrument();
//        $fi->setCreditCard($card);
//
//        // ### Payer
//        // A resource representing a Payer that funds a payment
//        // Use the List of `FundingInstrument` and the Payment Method
//        // as 'credit_card'
//        $payer = Paypalpayment::payer();
//        $payer->setPaymentMethod("credit_card")
//            ->setFundingInstruments(array($fi));
//
//        $item1 = Paypalpayment::item();
//        $item1->setName('Ground Coffee 40 oz')
//            ->setDescription('Ground Coffee 40 oz')
//            ->setCurrency('USD')
//            ->setQuantity(1)
//            ->setTax(0.3)
//            ->setPrice(7.50);
//
//        $item2 = Paypalpayment::item();
//        $item2->setName('Granola bars')
//            ->setDescription('Granola Bars with Peanuts')
//            ->setCurrency('USD')
//            ->setQuantity(5)
//            ->setTax(0.2)
//            ->setPrice(2);
//
//
//        $itemList = Paypalpayment::itemList();
//        $itemList->setItems(array($item1,$item2));
//
//
//        $details = Paypalpayment::details();
//        $details->setShipping("1.2")
//            ->setTax("1.3")
//            //total of items prices
//            ->setSubtotal("17.5");
//
//        //Payment Amount
//        $amount = Paypalpayment::amount();
//        $amount->setCurrency("USD")
//            // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
//            ->setTotal("20")
//            ->setDetails($details);
//
//        // ### Transaction
//        // A transaction defines the contract of a
//        // payment - what is the payment for and who
//        // is fulfilling it. Transaction is created with
//        // a `Payee` and `Amount` types
//
//        $transaction = Paypalpayment::transaction();
//        $transaction->setAmount($amount)
//            ->setItemList($itemList)
//            ->setDescription("Payment description")
//            ->setInvoiceNumber(uniqid());
//
//        // ### Payment
//        // A Payment Resource; create one using
//        // the above types and intent as 'sale'
//
//        $payment = Paypalpayment::payment();
//
//        $payment->setIntent("sale")
//            ->setPayer($payer)
//            ->setTransactions(array($transaction));
//
//        try {
//            // ### Create Payment
//            // Create a payment by posting to the APIService
//            // using a valid ApiContext
//            // The return object contains the status;
//            $payment->create($this->_apiContext);
//        } catch (\PPConnectionException $ex) {
//            return  "Exception: " . $ex->getMessage() . PHP_EOL;
//            exit(1);
//        }
//
//        dd($payment);
//    }

    public function store()
    {
        define('SITE_URL', 'http://localhost:8000/');
        $paypal= new ApiContext(new OAuthTokenCredential(
            'AZxoAZkS8ArNrjQO_8Od8Nzfi7kLn0eWM80eO6taCWI4NFpEFBHRD0mJ5URRnGIqgH8FR-yhnakpCxMB',
            'EFCPnVKwSXKGU7dUNFV9mWzgBYqIBwc3Vi8uy6injMXvsXwzcpXCNCjpWjsFoAWmWwwOuroPM2K13zsg'));

//        if (!isset($_POST['product'], $_POST['price'])){
//            die();
//        }
        $product= "subscribe";
        $price=10;
        $shipping=0;
        $total=$price + $shipping;
        $payer= new Payer();
        $payer->setPaymentMethod('paypal');
        $item= new Item();
        $item->setName($product)
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($price);
        $itemList= new ItemList();
        $itemList->setItems([$item]);
        $details= new Details();
        $details->setShipping($shipping)
            ->setSubtotal($price);
        $amount= new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($total)
            ->setDetails($details);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('PayForSmth')
            ->setInvoiceNumber(uniqid());
        $redirectUrls= new RedirectUrls();
        $redirectUrls->setReturnUrl(SITE_URL)
            ->setCancelUrl(SITE_URL . 'site/pay?success=false');
        $payment= new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);
        try
        {
            $payment->create($paypal);
        }
        catch (Exception $e)
        {
            die($e);
        }
        $approvalUrl= $payment->getApprovalLink();
        return redirect($approvalUrl);
    }


}
