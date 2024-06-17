<?php

return [
    'validation' => [
        'email' => [
            'required' => 'The email is required',
            'email' => 'The email is not in the correct format',
            'unique' => 'The email is already registered',
        ],
        'password' => [
            'required' => 'The password is required',
            'confirmed' => 'The password confirmation does not match',
        ],
        'name' => [
            'required' => 'The name is required',
        ],
        'lastname' => [
            'required' => 'The lastname is required',
        ],
        'avatar' => [
            'required' => 'The avatar is required',
        ],
        'type' => [
            'required' => 'The user type is required',
        ],
    ],
];
