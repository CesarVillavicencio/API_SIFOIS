<?php

return [
    'validation' => [
        'id' => ['required' => 'El id es requerido'],
        'name' => [
            'required' => 'El nombre es requerido',
            'max' => 'El numero de caracteres en el nombre es incorrecto',
            'min' => 'Por favor escriba mas de 4 caracteres para el nombre',
        ],
        'lastname' => [
            'required' => 'El apellido es requerido',
            'max' => 'El numero de caracteres en el apellido es incorrecto',
            'min' => 'Por favor escriba mas de 4 caracteres para el apellido',
        ],
        'email' => [
            'required' => 'El correo es requerido',
            'email' => 'El correo no tiene el formato correcto',
            'max' => 'El numero de caracteres en el correo es incorrecto',
            'min' => 'Por favor escriba mas de 4 caracteres para el correo',
            'unique' => 'Este correo ya esta en uso',
        ],
        'password' => [
            'required' => 'La contraseña es requerida',
            'max' => 'El numero de caracteres en la contraseña es incorrecto',
            'min' => 'Por favor escriba mas de 4 caracteres para la contraseña',
            'confirmed' => 'La confirmación de la contraseña no coincide',
        ],
        'avatar' => [
            'required' => 'El avatar es requerido',
        ],
        'phone' => [
            'max' => 'El numero de caracteres en el teléfono es incorrecto',
            'min' => 'Por favor escriba mas de 4 caracteres para el teléfono',
        ],

    ],
];
