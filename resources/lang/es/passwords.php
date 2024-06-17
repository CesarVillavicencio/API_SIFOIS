<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Password Reminder Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the password broker for a password update attempt
    | has failed, such as for an invalid token or invalid new password.
    |
    */

    'reset' => '¡Tu contraseña ha sido restablecida!',
    'sent' => '¡Te hemos enviado por correo el enlace para restablecer tu contraseña!',
    'throttled' => 'Por favor espera antes de intentar de nuevo.',
    'token' => 'El token de recuperación de contraseña es inválido.',
    'user' => 'No podemos encontrar ningún usuario con ese correo electrónico.',

    'view' => [
        'create_new_password_for_account' => 'Crear una nueva contraseña para tu cuenta',
        'error_list_message' => 'Error, algunos valores no son válidos...',
        'email' => 'Correo',
        'password' => 'Contraseña',
        'repeat_password' => 'Repetir Contraseña',
        'create_new_password' => 'Crear una nueva contraseña',
    ],

    'reset_mail' => [
        'subject' => 'Restablecer Contraseña',
        'greetings' => 'Hola!',
        'line1' => 'Está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.',
        'action' => 'Enlace para restablecer contraseña',
        'line2' => 'Este enlace de restablecimiento de contraseña caducará en 60 minutos.',
        'line3' => 'Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.',
        'line4' => '¡Gracias por usar nuestra aplicación!',
        'thanks' => 'Gracias desde',
        'regards' => 'Saludos',
    ],
];
