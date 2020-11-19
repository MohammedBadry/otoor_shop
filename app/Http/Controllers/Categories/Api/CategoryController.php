<?php

namespace App\Http\Controllers\Categories\Api;

use App\Models\Country;
use Illuminate\Routing\Controller;
use App\Http\Resources\Categories\CategoryResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the categories.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Country $country)
    {
        $categories = $country->categories()->filter()->paginate();

        return CategoryResource::collection($categories);
    }

    /**
     * Display the specified category.
     *
     * @param \App\Models\Country $country
     * @param mixed $category
     * @return \App\Http\Resources\Categories\CategoryResource
     */
    public function show(Country $country, $category)
    {
        return new CategoryResource(
            $country->categories()->findOrFail($category)->load('subcategories')
        );
    }
}
