<?php

namespace Database\Seeders\Sequences;

use Illuminate\Database\Eloquent\Factories\Sequence;

trait CategorySequence
{
    /**
     * @return \Illuminate\Database\Eloquent\Factories\Sequence
     */
    protected function categorySequence()
    {
        return new Sequence(
            [
                'name:ar' => 'عطورات عربية',
                'name:en' => 'Arabian perfumes',
                'display_in_navbar' => true,
                'description:ar' => 'أفضل عطور رجالية و عطور نسائية فى أكثر من 150 مدينة حول العالم',
                'description:en' => 'Best men\'s and women\'s perfumes in more than 150 cities around the world',
                'meta_description:ar' => 'أفضل عطور رجالية و عطور نسائية فى أكثر من 150 مدينة حول العالم',
                'meta_description:en' => 'Best men\'s and women\'s perfumes in more than 150 cities around the world',
                'meta_keywords:ar' => 'عطور رجالي,عطور حريمي,عطور عربية',
                'meta_keywords:en' => 'Men Perfumes,Women Perfumes,Arabian Perfumes',
            ],
            [
                'name:ar' => 'عطورات فرنسية',
                'name:en' => 'French perfumes',
                'display_in_navbar' => true,
                'description:ar' => 'أفضل عطور رجالية و عطور نسائية فى أكثر من 150 مدينة حول العالم',
                'description:en' => 'Best men\'s and women\'s perfumes in more than 150 cities around the world',
                'meta_description:ar' => 'أفضل عطور رجالية و عطور نسائية فى أكثر من 150 مدينة حول العالم',
                'meta_description:en' => 'Best men\'s and women\'s perfumes in more than 150 cities around the world',
                'meta_keywords:ar' => 'عطور رجالي,عطور حريمي,عطور فرنسية',
                'meta_keywords:en' => 'Men Perfumes,Women Perfumes,French Perfumes',
            ]
        );
    }
}