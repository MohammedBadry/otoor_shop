<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $products = Product::whereHas('categories', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        });

        $maxPrice = (int) (clone $products)->max('price');

        $maxPrice = $maxPrice == 0 ? 1000 : $maxPrice;

        $products = $products->filter()->paginate();

        return view('categories.show', get_defined_vars());
    }
}
