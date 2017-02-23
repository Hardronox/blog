@extends('layouts.app')

@section('pageTitle', 'Permission Denied')

@section('content')
<div class="container blog_create_container">
    <div class="row">
        <div class="col-md-7 col-md-offset-2">
            <div class="msg_subcribers">
                <h3><a href="{{ url("/blog/$article->id")}}">{{$article->title}}</a><br>Article is available only for subscribers.</h3>
            </div>
            <button class="subscribe_button">Become a Subscriber!</button>
        </div>
    </div>

    <div class="content" id="subscribe">
        <div class="row">
            <div class="col-md-7 col-md-offset-2" >
                <div class="become_subscriber">
                    <h4>
                        Become a subscriber and level up your skills!

                        As a premium subscriber you will have access to all videos, posts, and much more premium content.
                        <br>
                        Signup for only $10 a month.
                    </h4>
                    <h2 >Choose payment method:</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 col-md-offset-2 payment_block" >
                <div class="col-md-6 card_payment" >
                    <div class="payment_method" data-type="card">
                        <div class="payment_name">Credit card</div>
                        <img width="250px" height="250px"  src="{{Storage::url("images/site/credit_card.jpg")}}" alt="">
                    </div>
                </div>
                <div class="col-md-6 paypal_payment" >
                    <div class="payment_method" data-type="paypal">
                        <div class="payment_name">PayPal</div>
                        <img width="250px" height="250px" src="{{Storage::url("images/site/paypal_logo.png")}}" alt="">
                    </div>
                </div>
            </div>
        </div>
            <div class="row" >
                <div class="col-md-7 col-md-offset-2 " >
                    <div class="panel_footer">
                        <form action="/payment" method="post">
                            <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                data-key="pk_test_8CpwqO3s62lYAD4tUBlPfK8u"
                                data-amount="1000"
                                data-name="Subscription"
                                data-description="Subscription Payment!"
                                data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                data-locale="auto">
                            </script>
                            <input class="payment_button" type="submit" value="Proceed to Payment!" disabled="true">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
