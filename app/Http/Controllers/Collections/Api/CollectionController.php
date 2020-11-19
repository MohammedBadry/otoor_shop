<?php

namespace App\Http\Controllers\Collections\Api;

use App\Models\Collection;
use Illuminate\Routing\Controller;
use App\Http\Resources\Collections\CollectionResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CollectionController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the collections.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $collections = Collection::filter()->paginate();

        return CollectionResource::collection($collections);
    }

    /**
     * Display the specified collection.
     *
     * @param \App\Models\Collection $collection
     * @return \App\Http\Resources\Collections\CollectionResource
     */
    public function show(Collection $collection)
    {
        return new CollectionResource($collection);
    }
}
