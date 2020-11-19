<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the product "saved" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function saved(Product $product)
    {
        $categories = [];
        if ($category = $product->category) {
            $parent = $category;
            do {
                $categories[] = $parent->id;
                $parent = $parent->parent;
            } while ($parent);
        }

        $categories = array_reverse($categories);

        $product->categories()->sync($categories);
    }
}
