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
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'paypal' => [
        'client_id' => 'AU3Jt5ZguwdnCcKriL9_nk-U0RrGB-7-di9SwBwGjQbHcAvx1AvNmEtOG37v1Zgzk_8Iy44TKxloOLvw',
        'secret' => 'EDcL76gk8f_oEYS6a48wXAowB_5wIBW99YmL7MBm6NTOjAh92p1eay-pXQX1c4H7iodDH8YSYWSHuUfW'
    ],

];
