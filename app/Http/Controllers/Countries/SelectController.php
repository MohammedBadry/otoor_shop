<?php

namespace App\Http\Controllers\Countries;

use App\Models\City;
use App\Models\Country;
use Illuminate\Routing\Controller;
use App\Http\Filters\Countries\SelectFilter;
use App\Http\Resources\Countries\CitySelectResource;
use App\Http\Resources\Countries\CountrySelectResource;

class SelectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\Countries\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function countries(SelectFilter $filter)
    {
        $countries = Country::filter($filter)->paginate();

        return CountrySelectResource::collection($countries);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Filters\Countries\SelectFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function cities(SelectFilter $filter)
    {
        $countries = City::with('country')->filter($filter)->paginate();

        return CitySelectResource::collection($countries);
    }
}
