<?php

return [
    'mail_subject' => 'Información de Contacto',
    'validation' => [
        'name' => [
            'required' => 'El nombre es requerido',
            'max' => 'El numero de caracteres en el nombre es incorrecto',
            'min' => 'Por favor escriba mas de 4 caracteres para el nombre',
        ],
        'email' => [
            'required' => 'El correo es requerido',
            'email' => 'El correo no tiene el formato correcto',
            'max' => 'El numero de caracteres en el correo es incorrecto',
            'min' => 'Por favor escriba mas de 4 caracteres para el correo',
        ],
        'subject' => [
            'required' => 'El asunto es requerido',
            'max' => 'El numero de caracteres en el asunto es incorrecto',
            'min' => 'Por favor escriba mas de 4 caracteres para el asunto',
        ],
        'comment' => [
            'required' => 'El comentario es requerido',
        ],
        'captcha' => [
            'invalid' => 'CAPTCHA Inválido. Necesitas demostrar que eres humano.',
        ],
    ],
];
