<?php

return [
    'validation' => [
        'id' => ['required' => 'The id is required'],
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
        'avatar' => [
            'required' => 'The avatar is required',
        ],
        'phone' => [
            'max' => 'The number of characters in the phone are incorrect',
            'min' => 'Please type more than 4 characters for phone',
        ],
    ],
];
