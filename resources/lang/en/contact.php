<?php

return [
    'mail_subject' => 'Contact Information',
    'validation' => [
        'name' => [
            'required' => 'The name is required',
            'max' => 'The number of characters in the name are incorrect',
            'min' => 'Please type more than 4 characters for name',
        ],
        'email' => [
            'required' => 'The email is required',
            'email' => 'The email is not in the correct format',
            'max' => 'The number of characters in the email are incorrect',
            'min' => 'Please type more than 4 characters for email',
        ],
        'subject' => [
            'required' => 'The subject is required',
            'max' => 'The number of characters in the subject are incorrect',
            'min' => 'Please type more than 4 characters for subject',
        ],
        'comment' => [
            'required' => 'The comment is required',
        ],
        'captcha' => [
            'invalid' => 'Invalid CAPTCHA. You need to prove that you are human.',
        ],
    ],
];
