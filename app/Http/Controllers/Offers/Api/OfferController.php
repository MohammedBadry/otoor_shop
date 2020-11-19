<?php

namespace App\Http\Controllers\Offers\Api;

use App\Models\Offer;
use Illuminate\Routing\Controller;
use App\Http\Resources\Offers\OfferResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OfferController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the offers.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $offers = Offer::filter()->paginate();

        return OfferResource::collection($offers);
    }

    /**
     * Display the specified offer.
     *
     * @param \App\Models\Offer $offer
     * @return \App\Http\Resources\Offers\OfferResource
     */
    public function show(Offer $offer)
    {
        return new OfferResource($offer->load('category'));
    }
}
