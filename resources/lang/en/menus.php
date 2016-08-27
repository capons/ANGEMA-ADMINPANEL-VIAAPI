<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Access Management',

            'permissions' => [
                'all' => 'All Permissions',
                'create' => 'Create Permission',
                'edit' => 'Edit Permission',
                'groups' => [
                    'all' => 'All Groups',
                    'create' => 'Create Group',
                    'edit' => 'Edit Group',
                    'main' => 'Groups',
                ],
                'main' => 'Permissions',
                'management' => 'Permission Management',
            ],

            'roles' => [
                'all' => 'All Roles',
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',
                'main' => 'Roles',
            ],

            'users' => [
                'all' => 'All Users',
                'change-password' => 'Change Password',
                'create' => 'Create User',
                'deactivated' => 'Deactivated Users',
                'deleted' => 'Deleted Users',
                'edit' => 'Edit User',
                'main' => 'Users',
            ],
        ],

        'log-viewer' => [
            'main' => 'Log Viewer',
            'dashboard' => 'Dashboard',
            'logs' => 'Logs',
        ],

        'sidebar' => [
            'home' => 'Home',
            'dashboard' => 'Dashboard',
            'general' => 'General',
        ],
    ],

    'engena' => [
        'passes' => [
            'all'    => 'All Passes',
            'add'    => 'Add Pass',
            'create' => 'Create Pass',
            'edit'   => 'Edit Pass',
            'main'   => 'Passes',
        ],
        'passDurations' => [
            'all'    => 'All Pass Durations',
            'add'    => 'Add Pass Duration',
            'create' => 'Create Pass Duration',
            'edit'   => 'Edit Pass Duration',
            'main'   => 'Pass Durations',
        ],
        'passTypes' => [
            'all'    => 'All Pass Types',
            'add'    => 'Add Pass Type',
            'create' => 'Create Pass Type',
            'edit'   => 'Edit Pass Type',
            'main'   => 'Pass Types',
        ],
        'regions' => [
            'all'    => 'All Regions',
            'add'    => 'Add Region',
            'create' => 'Create Region',
            'edit'   => 'Edit Region',
            'main'   => 'Regions',
        ],
        'reserves' => [
            'all'    => 'All Reserves',
            'add'    => 'Add Reserve',
            'create' => 'Create Reserve',
            'edit'   => 'Edit Reserve',
            'main'   => 'Reserves',
            'management' => 'Reserve Management',
        ],
        'reserveEntrances' => [
            'all'    => 'All Reserve Entrances',
            'add'    => 'Add Reserve Entrance',
            'create' => 'Create Reserve Entrance',
            'edit'   => 'Edit Reserve Entrance',
            'main'   => 'Reserve Entrances',
        ],
        'trails' => [
            'all'    => 'All Trails',
            'add'    => 'Add Trail',
            'create' => 'Create Trail',
            'edit'   => 'Edit Trail',
            'main'   => 'Trails',
        ],
    ],

    'language-picker' => [
        'language' => 'Language',
        /**
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'da' => 'Danish',
            'de' => 'German',
            'en' => 'English',
            'es' => 'Spanish',
            'fr' => 'French',
            'it' => 'Italian',
            'pt-BR' => 'Brazilian Portuguese',
            'sv' => 'Swedish',
        ],
    ],
];
