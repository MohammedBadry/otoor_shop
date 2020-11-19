<?php

namespace App\Http\Controllers\Categories;

use App\Models\Category;
use Illuminate\Routing\Controller;
use App\Http\Filters\Categories\SelectFilter;
use App\Http\Resources\Categories\SelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\Categories\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(SelectFilter $filter)
    {
        $categories = country()->categories()->leafsOnly()->filter($filter)->paginate();

        return SelectResource::collection($categories);
    }
}
