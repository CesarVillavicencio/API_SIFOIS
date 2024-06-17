<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Password Reset Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'reset' => 'Your password has been reset!',
    'sent' => 'We have emailed your password reset link!',
    'throttled' => 'Please wait before retrying.',
    'token' => 'This password reset token is invalid.',
    'user' => "We can't find a user with that email address.",

    'view' => [
        'create_new_password_for_account' => 'Create a new password for your account',
        'error_list_message' => 'Error, some values are not valid...',
        'email' => 'Email',
        'password' => 'Password',
        'repeat_password' => 'Repeat Password',
        'create_new_password' => 'Create a new password',
    ],

    'reset_mail' => [
        'subject' => 'Password Reset',
        'greetings' => 'Hello!',
        'line1' => 'You are receiving this email because we received a password reset request for your account.',
        'action' => 'Link to Reset Password',
        'line2' => 'This password reset link will expire in 60 minutes.',
        'line3' => 'If you did not request a password reset, no further action is required.',
        'line4' => 'Thank you for using our application!',
        'thanks' => 'Thanks from',
        'regards' => 'Regards',
    ],

];
