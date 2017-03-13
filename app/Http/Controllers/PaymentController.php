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
        Stripe::setApiKey('sk_test_4C6CImPBbhbExiGDtmHZ2nI6');

        $customer= Customer::create([
            'email'=>request('stripeEmail'),
            'source'=>request('stripeToken')
        ]);

        Charge::create([
           'customer'=>$customer->id,
            'amount'=>1000,
            'currency'=>'usd'
        ]);

        return redirect('/payment/success');
    }


	/**
	 *  redirct on this action after payment is complete
	 */
	public function successPayment(Request $request)
    {
        $article_id = $request->session()->get('article_id');

        $user = Auth::user();

        if(!$user->hasRole('subscriber')) {
            $user->roles()->attach(2);
        }
        else
            return redirect("/blog/$article_id");


        $article=Articles::find(intval($article_id));

        return view('site.success-payment', ['article'=>$article]);
    }
}