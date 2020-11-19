<?php

namespace App\Http\Controllers\Currencies\Api;

use App\Models\Currency;
use Illuminate\Routing\Controller;
use App\Http\Resources\Currencies\CurrencyResource;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CurrencyController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Display a listing of the currencies.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $currencies = Currency::filter()->paginate();

        return CurrencyResource::collection($currencies);
    }

    /**
     * Display the specified currency.
     *
     * @param \App\Models\Currency $currency
     * @return \App\Http\Resources\Currencies\CurrencyResource
     */
    public function show(Currency $currency)
    {
        return new CurrencyResource($currency);
    }

    /**
     * Display the specified currency.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \App\Http\Resources\Currencies\CurrencyResource
     */
    public function default()
    {
        $currency = Currency::default()->firstOrFail();

        $this->authorize('view', $currency);

        return new CurrencyResource($currency);
    }
}
