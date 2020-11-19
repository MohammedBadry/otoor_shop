<?php

namespace App\Http\Controllers\Countries\Dashboard;

use App\Models\City;
use App\Models\Country;
use Illuminate\Routing\Controller;
use App\Http\Requests\Countries\CityRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CityController extends Controller
{
    use AuthorizesRequests;

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Countries\CityRequest $request
     * @param \App\Models\Country $country
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CityRequest $request, Country $country)
    {
        $this->authorize('create', City::class);

        $country->cities()->create($request->all());

        flash(trans('cities.messages.created'));

        return redirect()->route('dashboard.countries.show', $country);
    }

    /**
     * Display the city edit form.
     *
     * @param \App\Models\Country $country
     * @param \App\Models\City $city
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country, City $city)
    {
        $this->authorize('update', [$city, $country]);

        return view('dashboard.cities.edit', compact('country', 'city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Countries\CityRequest $request
     * @param \App\Models\Country $country
     * @param \App\Models\City $city
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CityRequest $request, Country $country, City $city)
    {
        $this->authorize('update', [$city, $country]);

        $city->update($request->all());

        flash(trans('cities.messages.updated'));

        return redirect()->route('dashboard.countries.show', $country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Country $country
     * @param \App\Models\City $city
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Country $country, City $city)
    {
        $this->authorize('delete', [$city, $country]);

        $city->delete();

        flash(trans('cities.messages.deleted'));

        return redirect()->route('dashboard.countries.show', $country);
    }
}
