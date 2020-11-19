<?php

namespace App\Http\Controllers\Sizes;

use App\Models\Size;
use Illuminate\Routing\Controller;
use App\Http\Filters\Sizes\SelectFilter;
use App\Http\Resources\Sizes\SelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\Sizes\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(SelectFilter $filter)
    {
        $sizes = Size::filter($filter)->paginate();

        return SelectResource::collection($sizes);
    }
}
