<?php

return [
    'roles' => [
        'super_user' => [
            'name'      => 'admin.roles.super_user',
            'sub_roles' => ['admin'],
        ],
        'admin'      => [
            'name'      => 'admin.roles.admin',
            'sub_roles' => ['htx'],
        ],
        'htx'      => [
            'name'      => 'admin.roles.htx',
            'sub_roles' => ['farmer'],
        ],
        'farmer'      => [
            'name'      => 'admin.roles.farmer',
            'sub_roles' => [],
        ]
    ],
];
