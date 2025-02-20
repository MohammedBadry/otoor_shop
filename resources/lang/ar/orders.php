<?php

return [
    'singular' => 'الطلب',
    'plural' => 'الطلبات',
    'empty' => 'لا يوجد طلبات حتى الان',
    'count' => 'عدد الطلبات',
    'earnings' => 'الارباح',
    'statistics' => 'احصائيات الطلبات',
    'search' => 'بحث',
    'select' => 'اختر الطلب',
    'perPage' => 'عدد النتائج بالصفحة',
    'filter' => 'ابحث عن طلب',
    'actions' => [
        'list' => 'عرض الكل',
        'create' => 'اضافة طلب',
        'show' => 'عرض الطلب',
        'edit' => 'تعديل الطلب',
        'delete' => 'حذف الطلب',
        'options' => 'خيارات',
        'save' => 'حفظ',
        'filter' => 'بحث',
    ],
    'messages' => [
        'created' => 'تم اضافة الطلب بنجاح.',
        'updated' => 'تم تعديل الطلب بنجاح.',
        'deleted' => 'تم حذف الطلب بنجاح.',
    ],
    'attributes' => [
        'id' => 'رقم الطلب',
        'user_id' => 'العميل',
        'product_id' => 'المنتج',
        'qty' => 'الكمية',
        'gift_message' => 'رسالة الهدية',
        'city' => 'المدينة',
        'name' => 'الاسم',
        'phone' => 'رقم الهاتف',
        'area' => 'المنطقة',
        'street' => 'الشارع',
        'address' => 'العنوان',
        'paid' => 'المبلغ المدفوع',
        'total' => 'الاجمالي',
        'status' => 'حالة الطلب',
        'payment_method' => 'طريقة الدفع',
    ],
    'statuses' => [
        \App\Models\Order::PENDING => 'قيد المراجعة',
        \App\Models\Order::IN_PROGRESS => 'قيد التنفيذ',
        \App\Models\Order::CANCELED => 'تم الالغاء',
        \App\Models\Order::REJECTED => 'تم الرفض',
        \App\Models\Order::DELIVERED => 'تم الاستلام',
    ],
    'payment_methods' => [
        'visa' => 'فيزا',
        'on-delivered' => 'عند الاستلام',
    ],
    'dialogs' => [
        'delete' => [
            'title' => 'تحذير !',
            'info' => 'هل انت متأكد انك تريد حذف الطلب',
            'confirm' => 'حذف',
            'cancel' => 'الغاء',
        ],
    ],
];
