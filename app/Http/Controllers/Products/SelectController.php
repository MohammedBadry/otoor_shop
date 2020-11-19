<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Routing\Controller;
use App\Http\Filters\Products\SelectFilter;
use App\Http\Resources\Products\SelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\Products\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(SelectFilter $filter)
    {
        $products = Product::whereHas('category', function ($query) {
            $query->where('country_id', country()->id);
        })->filter($filter)->paginate();

        return SelectResource::collection($products);
    }
}
