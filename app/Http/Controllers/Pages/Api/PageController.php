<?php

namespace App\Http\Controllers\Pages\Api;

use App\Models\Page;
use Illuminate\Routing\Controller;
use App\Http\Resources\Pages\PageResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PageController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the pages.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $pages = Page::filter()->paginate();

        return PageResource::collection($pages);
    }

    /**
     * Display the specified page.
     *
     * @param \App\Models\Page $page
     * @return \App\Http\Resources\Pages\PageResource
     */
    public function show(Page $page)
    {
        return new PageResource($page);
    }
}
