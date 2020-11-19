<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Handle the category "saving" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function saving(Category $category)
    {
        if ($category->parent) {
            Category::withoutEvents(function () use ($category) {
                $category->forceFill([
                    'country_id' => $category->parent->country_id,
                ]);
            });
        }
    }
}
