<?php

use App\Models\Product;
use App\Models\Category;

/* @var \App\Models\Product $product */

Category::whereTranslation('name', 'French perfumes')
    ->each(function (Category $category) {
        $product = Product::factory([
            'name:en' => 'Avon Artistique Parfumiers Magnolia en Fleurs - 50ml',
            'name:ar' => 'برفان فرنسي مجنوليا فلورز من إيڤون أرتيستيك - 50 مل',
            'price' => 350,
            'description:en' => '<ul>
                <li>Size : 50ml</li>
                <li>Fragrance Type : Eau de Parfum</li>
                <li>Brand : Avon</li>
                <li>Fragrance Family : Floral</li>
                <li>Perfume Name  : Artistique Parfumiers</li>
                <li>Targeted Group : Women</li>
                <li>Expirable : No</li>
                <li>Manufacturer Number : 001</li>
            </ul>',
            'description:ar' => '<ul>
                <li>الحجم : 50 مل</li>
                <li>نوع العطر : او دى بارفان</li>
                <li>العلامة التجارية : افون</li>
                <li>عائلة العطر : الروائح الوردية</li>
                <li>Perfume Name  : null</li>
                <li>المجموعة المستهدفة : نساء</li>
                <li>Expirable : 0</li>
                <li>الرقم المصنعي : ...  </li>
            </ul>',
            'meta_description:ar' => 'أفضل عطور رجالية و عطور نسائية فى أكثر من 150 مدينة حول العالم',
            'meta_description:en' => 'Best men\'s and women\'s perfumes in more than 150 cities around the world',
            'meta_keywords:ar' => 'عطور رجالي,عطور حريمي,عطور فرنسية',
            'meta_keywords:en' => 'Men Perfumes,Women Perfumes,French Perfumes',
            'category_id' => $category,
        ])->create();

        $product->addMedia(__DIR__.'/01.jpg')->preservingOriginal()->toMediaCollection();
    });
