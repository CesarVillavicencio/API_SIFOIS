<?php

return [
    'validation' => [
        'email' => [
            'required' => 'El correo es requerido',
            'email' => 'El correo no tiene el formato correcto',
            'unique' => 'Este correo ya esta en uso',
        ],
        'password' => [
            'required' => 'La contraseña es requerida',
            'confirmed' => 'La confirmación de la contraseña no coincide',
        ],
        'name' => [
            'required' => 'El nombre es requerido',
        ],
        'lastname' => [
            'required' => 'El apellido es requerido',
        ],
        'avatar' => [
            'required' => 'El avatar es requerido',
        ],
        'type' => [
            'required' => 'El tipo de usuario es requerido',
        ],
    ],
];
