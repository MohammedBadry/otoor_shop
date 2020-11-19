<?php

namespace App\Http\Controllers\Pages;

use App\Models\Page;
use Illuminate\Routing\Controller;
use App\Http\Filters\Pages\SelectFilter;
use App\Http\Resources\Pages\SelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\Pages\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(SelectFilter $filter)
    {
        $pages = Page::filter($filter)->paginate();

        return SelectResource::collection($pages);
    }
}
