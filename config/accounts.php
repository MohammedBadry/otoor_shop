<?php

use App\Models\User;

return [

    /*
     * The firebase project id for password less authentication.
     */
    'firebase_project_id' => env('FIREBASE_PROJECT_ID'),


    'services' => [

        User::CUSTOMER_TYPE => App\Support\Accounts\CustomerServices::class,

        'as' => [
            User::ADMIN_TYPE => [
                User::CUSTOMER_TYPE => App\Support\Accounts\ActingAs\Admin\CustomerServices::class,
            ],
        ],
    ],
];
