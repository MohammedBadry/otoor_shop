<?php

namespace App\Http\Controllers\Countries\Api;

use App\Models\Country;
use Illuminate\Routing\Controller;
use App\Http\Resources\Countries\CountryResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CountryController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the countries.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $countries =Country::filter()->paginate();

        return CountryResource::collection($countries);
    }

    /**
     * Display the specified country.
     *
     * @param \App\Models\Country $country
     * @return \App\Http\Resources\Countries\CountryResource
     */
    public function show(Country $country)
    {
        $country->load('cities');

        return new CountryResource($country);
    }

    /**
     * Display the specified country.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \App\Http\Resources\Countries\CountryResource
     */
    public function default()
    {
        $country = Country::default()->with('cities')->firstOrFail();

        $this->authorize('view', $country);

        return new CountryResource($country);
    }
}
