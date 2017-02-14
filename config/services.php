<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

	'stripe' => [
		'model' => App\Models\User::class,
		'key' => env('STRIPE_KEY'),
		'secret' => env('STRIPE_SECRET'),
	],
	'vkontakte' => [
		'client_id' => '5605709',
		'client_secret' => '8DNggVj10tMLb57TEDKC',
		'redirect' => 'http://localhost:8000/vk/auth',
	],
	'facebook' => [
		'client_id' => '1770307853244780',
		'client_secret' => '27575af7ad2fa431e9f6755b19ecf1c3',
		'redirect' => 'http://localhost:8000/auth/facebook/callback',
	],

];
