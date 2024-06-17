<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'validation' => [
        'email' => [
            'required' => 'The email is required',
            'email' => 'The email is not in the correct format',
            'max' => 'The number of characters in the email are incorrect',
            'min' => 'Please type more than 4 characters for email',
            'unique' => 'The email is already registered',
        ],
        'password' => [
            'required' => 'The password is required',
            'max' => 'The number of characters in the password are incorrect',
            'min' => 'Please type more than 4 characters for password',
            'confirmed' => 'The password confirmation does not match',
        ],
        'name' => [
            'required' => 'The name is required',
            'max' => 'The number of characters in the name are incorrect',
            'min' => 'Please type more than 4 characters for name',
        ],
        'lastname' => [
            'required' => 'The lastname is required',
            'max' => 'The number of characters in the lastname are incorrect',
            'min' => 'Please type more than 4 characters for lastname',
        ],
        'phone' => [
            'required' => 'The phone is required',
            'max' => 'The number of characters in the phone are incorrect',
            'min' => 'Please type more than 4 characters for phone',
        ],
        'captcha' => [
            'invalid' => 'Invalid CAPTCHA. You need to prove that you are human.',
        ],
    ],
];
