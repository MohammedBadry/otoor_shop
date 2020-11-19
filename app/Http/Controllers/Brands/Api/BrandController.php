<?php

namespace App\Http\Controllers\Brands\Api;

use App\Models\Brand;
use Illuminate\Routing\Controller;
use App\Http\Resources\Brands\BrandResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BrandController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the brands.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $brands = Brand::filter()->paginate();

        return BrandResource::collection($brands);
    }

    /**
     * Display the specified brand.
     *
     * @param \App\Models\Brand $brand
     * @return \App\Http\Resources\Brands\BrandResource
     */
    public function show(Brand $brand)
    {
        return new BrandResource($brand);
    }
}
