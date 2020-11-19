<?php

namespace App\Http\Controllers\Currencies\Dashboard;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\CurrencyExchangeRate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class CurrencyRateController extends Controller
{
    use AuthorizesRequests;

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Currency $currency
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Throwable
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Currency $currency)
    {
        $this->authorize('create', CurrencyExchangeRate ::class);

        DB::beginTransaction();
        foreach ($request->input('rates', []) as $rate) {
            $rate['day'] = today();

            $currency->rates()->create($rate);
        }
        DB::commit();

        flash(trans('currencies.messages.rate-created'));

        return redirect()->route('dashboard.currencies.show', $currency);
    }

    /**
     * Display the $currencyExchangeRate edit form.
     *
     * @param \App\Models\Currency $currency
     * @param \App\Models\CurrencyExchangeRate $currencyExchangeRate
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency, CurrencyExchangeRate $currencyExchangeRate)
    {
        $this->authorize('update', [$currencyExchangeRate, $currency]);

        return view('dashboard.cities.edit', compact('currency', '$currencyExchangeRate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Currencies\CityRequest $request
     * @param \App\Models\Currency $currency
     * @param \App\Models\CurrencyExchangeRate $currencyExchangeRate
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CityRequest $request, Currency $currency, CurrencyExchangeRate $currencyExchangeRate)
    {
        $this->authorize('update', [$currencyExchangeRate, $currency]);

        $currencyExchangeRate->update($request->all());

        flash(trans('cities.messages.updated'));

        return redirect()->route('dashboard.currencies.show', $currency);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Currency $currency
     * @param \App\Models\CurrencyExchangeRate $currencyExchangeRate
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Currency $currency, CurrencyExchangeRate $currencyExchangeRate)
    {
        $this->authorize('delete', [$currencyExchangeRate, $currency]);

        $currencyExchangeRate->delete();

        flash(trans('cities.messages.deleted'));

        return redirect()->route('dashboard.currencies.show', $currency);
    }
}
