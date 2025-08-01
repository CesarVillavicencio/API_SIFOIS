<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model {
    protected $table = 'admin_configuration';

    protected $fillable = ['options'];

    protected $casts = [
        'options' => 'array',
    ];

    /*
    'navbar_back_color' => 'is-light',
    'sidebar_back_color' => 'has-background-light',
    'login_background_url' => null,
    'contact_email' => 'arturo@komvac.com',
    'front_site_up' => true,
    'header_search' => true,
    'transition' => 'fade',
    'language' => 'es',
    'shortcuts' => [
        [
            'name' => 'dashboard',
            'route_name' => 'Dashboard Index',
            'route' => '/dashboard/index'
        ],
        [
            'name' => 'users',
            'route_name' => 'Users List',
            'route' => '/users/list'
        ],
        [
            'name' => 'configuration',
            'route_name' => 'Configuration Edit',
            'route' => '/configuration/edit'
        ]
    ],
    'admin_logo' => 'admin/configuration/komvac-icon-144x144.png'
    */
}
