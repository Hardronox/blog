@extends('layouts.app')

@section('pageTitle', 'Permission Denied')

@section('content')
    {{--<link rel="stylesheet" href="{{ URL::asset('js/init.js') }}">--}}
    {!!Html::script('js/site/subscribe.js')!!}

<div class="container blog_create_container">
    <div class="content">
        <div class="row">
            <div class="col-md-5 col-md-offset-4">
                <div style="text-align: center;margin-left: -28%;">
                    <h3><a href="/blog/{{$article->id}}">{{$article->title}}</a><br> Article is available only for subscribers.</h3>
                </div>
                <button class="subscribe_button">Become a Subscriber!</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-5 col-md-offset-4" >
                <div style="text-align: center;margin-left: -28%; background-color: #00a7ff; color: white;">
                    <h4>
                        Become a subscriber and level up your skills!

                        As a premium subscriber you will have access to all videos, posts, books, and much more premium content.
                        Signup for only $10 a month.
                    </h4>
                    <h2 >Choose payment method:</h2>
                    <div>
                        <span style="color: black;">Credit card</span>
                        <span style="color: black;">PayPal</span>
                    </div>
                    <div style="margin-top: 10px;">
                        <div class="col-md-6" style="border-left:1px solid #00a7ff; border-bottom:1px solid #00a7ff;">
                            <div class="payment_method" data-type="card">

                                <img width="250px" height="250px"  src="/images/credit_card.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 " style="border-right:1px solid #00a7ff; border-bottom:1px solid #00a7ff;">
                            <div class="payment_method" data-type="paypal">
                                <img width="250px" height="250px" src="/images/paypal_logo.png" alt="">
                            </div>
                        </div>
                    </div>

                </div>
                <div style="height: 150px; background-color: gainsboro">
                    <a class="btn btn-success payment_button" href="#">Proceed to Payment!</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

