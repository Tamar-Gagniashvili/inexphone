<?php

return [
    /*
    |--------------------------------------------------------------------------
    | InexPHONE SMS API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for the InexPHONE SMS service integration.
    |
    */

    'api_url' => env('INEXPHONE_SMS_API_URL', 'https://smsservice.inexphone.ge/api/v1'),

    'api_token' => env('INEXPHONE_SMS_API_TOKEN'),

    'default_subject' => env('INEXPHONE_SMS_DEFAULT_SUBJECT', 'YourApp'),

    'default_otp_expires_in' => env('INEXPHONE_SMS_DEFAULT_OTP_EXPIRES_IN', 60),

    'default_otp_text' => env('INEXPHONE_SMS_DEFAULT_OTP_TEXT', 'Your verification code is: {{CODE}}'),

    'timeout' => env('INEXPHONE_SMS_TIMEOUT', 30),

    'retry_attempts' => env('INEXPHONE_SMS_RETRY_ATTEMPTS', 3),

    'retry_delay' => env('INEXPHONE_SMS_RETRY_DELAY', 1000),
];
