<?php

return [
    /*
    |-------------------------------------------------------------------------------
    | Connections
    |-------------------------------------------------------------------------------
    |
    | The twilio connection has already been implemented for you. If you need additional
    | connections or custom implementations of the interfaces you can add them to the
    | configuration here.
    |
    */
    'twilio' => [
        /*
        |--------------------------------------------------------------------------
        | SID
        |--------------------------------------------------------------------------
        |
        | Your Twilio Account SID #
        |
        */
        'sid' => env('TWILIO_SID', ''),

        /*
        |--------------------------------------------------------------------------
        | Access Token
        |--------------------------------------------------------------------------
        |
        | Access token that can be found in your Twilio dashboard
        |
        */
        'token' => env('TWILIO_TOKEN', ''),

        /*
        |--------------------------------------------------------------------------
        | From Number
        |--------------------------------------------------------------------------
        |
        | The Phone number registered with Twilio that your SMS & Calls will come from,
        | You can override this when making calls and sms messages by setting the new number
        | in $params['from']
        |
        */
        'from' => env('TWILIO_FROM', ''),
    ]
];
