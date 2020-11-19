<?php

return [
    'plural' => 'العضويات',
    'types' => [
        \App\Models\User::ADMIN_TYPE => 'مسئول',
        \App\Models\User::CUSTOMER_TYPE => 'عميل',
    ],
    'impersonate' => [
        'go' => 'الذهاب للوحة التحكم',
        'leave' => 'العودة للحساب السابق',
    ],
];
