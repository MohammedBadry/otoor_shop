<?php

namespace App\Http\Controllers\Sizes\Api;

use App\Models\Size;
use Illuminate\Routing\Controller;
use App\Http\Resources\Sizes\SizeResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SizeController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the sizes.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $sizes = Size::filter()->paginate();

        return SizeResource::collection($sizes);
    }

    /**
     * Display the specified size.
     *
     * @param \App\Models\Size $size
     * @return \App\Http\Resources\Sizes\SizeResource
     */
    public function show(Size $size)
    {
        return new SizeResource($size);
    }
}
