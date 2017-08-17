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
        'client_id' => 'ARd7zZ_c0rmV-IIzAgONgM7oNP7p3M81PCnSIN2xhVZ_UbaRY5LkNJmbaQ1JW6xy8sqpLci_3YLjVJDY',
        'secret' => 'ENGhq7e_ePAYl0A5KuD6U79wUWVVWMd7wz_-TR8N4J76WWhknPELolSWszJiwuAY-IrMfSYsGN2-UWCj'
    ],

];
