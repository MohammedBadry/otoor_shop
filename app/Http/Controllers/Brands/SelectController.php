<?php

namespace App\Http\Controllers\Brands;

use App\Models\Brand;
use Illuminate\Routing\Controller;
use App\Http\Filters\Brands\SelectFilter;
use App\Http\Resources\Brands\SelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\Brands\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(SelectFilter $filter)
    {
        $brands = Brand::filter($filter)->paginate();

        return SelectResource::collection($brands);
    }
}
