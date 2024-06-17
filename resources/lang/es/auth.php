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

    'failed' => 'Estas credenciales no coinciden con nuestros registros.',
    'password' => 'La contraseña proporcionada es incorrecta.',
    'throttle' => 'Demasiados intentos de acceso. Por favor intente nuevamente en :seconds segundos.',
    'validation' => [
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
        'phone' => [
            'required' => 'El teléfono es requerido',
            'max' => 'El numero de caracteres en el teléfono es incorrecto',
            'min' => 'Por favor escriba mas de 4 caracteres para el teléfono',
        ],
        'captcha' => [
            'invalid' => 'CAPTCHA Inválido. Necesitas demostrar que eres humano.',
        ],
    ],
];
