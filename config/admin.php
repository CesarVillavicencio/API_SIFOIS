<?php

return [
    // Init Values
    'app_name' => env('APP_NAME', 'Komvac Admin'),

    // Users Roles
    'user_types' => ['suadmin', 'admin', 'editor'],

    // Configuration Values
    'configuration' => [
        'navbar_back_color' => 'is-light',
        'sidebar_back_color' => 'has-background-light',
        'login_background_url' => null,
        'contact_email' => 'arturo@komvac.com',
        'front_site_up' => false,
        'header_search' => true,
        'transition' => 'fade',
        'language' => 'es',
        'shortcuts' => [
            [
                'name' => 'dashboard',
                'route_name' => 'Dashboard Index',
            ],
            [
                'name' => 'users',
                'route_name' => 'Users List',
            ],
            [
                'name' => 'configuration',
                'route_name' => 'Configuration Edit',
            ],
        ],
        'admin_logo' => 'admin/configuration/komvac-icon-144x144.png',
    ],
];
