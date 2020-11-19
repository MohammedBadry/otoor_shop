<?php

use App\Models\Product;
use App\Models\Category;

/* @var \App\Models\Product $product */

$category = Category::whereTranslation('name', 'Arabian perfumes')
    ->each(function ($category) {
        $product = Product::factory([
            'name:en' => 'Ana Abiyedh Rouge by Lattafa f 60ml',
            'name:ar' => 'عطر انا الابيض روج من لطافة 60 مل',
            'meta_description:en' => 'Ana Abiyedh Rouge by Lattafa f 60ml : Buy Online Perfumes & Fragrances at Best Prices',
            'meta_description:ar' => 'اشتري عطر انا الابيض روج من لطافة 60 مل : تسوق اونلاين عطور بافضل اسعار',
            'price' => 275,
            'description:en' => '<ul>
                <li>Manufacturer Number : 6291106066890</li>
                <li>Expirable : 0</li>
                <li>Targeted Group : Unisex</li>
                <li>Perfume Name  : Ana Abiyedh Rouge	</li>
                <li>Fragrance Family : Woody &amp; Spicy</li>
                <li>Brand : Lattafa Parfums	</li>
            </ul>',
            'description:ar' => '<ul>
                <li >الرقم المصنعي : 6291106066890</li>
                <li >يخضع لإنتهاء الصلاحية : لا</li>
                <li >المجموعة المستهدفة : للجنسين</li>
                <li>إسم العطر : انا الابيض روج	</li>
                <li >عائلة العطر : الروائح الخشبية والتوابل</li>
                <li>العلامة التجارية : عطور لطافة ...  </li>
            </ul>',
            'meta_keywords:ar' => 'عطور رجالي,عطور حريمي,عطور عربية',
            'meta_keywords:en' => 'Men Perfumes,Women Perfumes,Arabian Perfumes',
            'category_id' => $category,
        ])->create();

        $product->addMedia(__DIR__.'/01.jpg')->preservingOriginal()->toMediaCollection();
    });

