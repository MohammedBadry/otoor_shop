<?php

return [
    'singular' => 'Coupon',
    'plural' => 'Coupons',
    'empty' => 'There are no coupons yet.',
    'count' => 'Coupons Count.',
    'search' => 'Search',
    'select' => 'Select Coupon',
    'perPage' => 'Results Per Page',
    'filter' => 'Search for coupon',
    'actions' => [
        'list' => 'List All',
        'create' => 'Create a new coupon',
        'show' => 'Show coupon',
        'edit' => 'Edit coupon',
        'delete' => 'Delete coupon',
        'options' => 'Options',
        'save' => 'Save',
        'filter' => 'Filter',
    ],
    'messages' => [
        'created' => 'The coupon has been created successfully.',
        'updated' => 'The coupon has been updated successfully.',
        'deleted' => 'The coupon has been deleted successfully.',
    ],
    'attributes' => [
        'name' => 'Coupon name',
        '%name%' => 'Coupon name',
        'code' => 'Coupon Code',
        'value' => 'Discount Percentage',
        'min_total' => 'Minimum Total',
        'usage_count' => 'Usage Count',
        'usage_per_user' => 'Usage Count Per User',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'Warning !',
            'info' => 'Are you sure you want to delete the coupon?',
            'confirm' => 'Delete',
            'cancel' => 'Cancel',
        ],
    ],
];
