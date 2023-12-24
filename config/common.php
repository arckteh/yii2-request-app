<?php

$config['components']['urlManager']['rules'] = [
    // admin
    'admin' => 'admin/index/index',
    'admin/login' => 'admin/index/login',
    'admin/logout' => 'admin/index/logout',
];

$config['modules'] = [
    'admin' => [
        'class' => 'app\modules\admin\Module',
        'defaultRoute' => 'index/index',
        'layout' => 'main',
    ],
];