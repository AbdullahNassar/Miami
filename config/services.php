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
        'client_id' => 'AQV3I23o34QyZ194O1qSgDZvSA9j17nhirATQnHz3Tbfwv2lLrMfeABnmtMM-sCSwAemptkv1ZpDmbu4',
        'secret' => 'ENILHN2gbjtK1FeHHuI0iHoQ5atHmM26VjkIKXynJQG7oyU7Mo3F5rGXaaoYHksakz_b42B6c_Ud_yA8'
    ],


];
