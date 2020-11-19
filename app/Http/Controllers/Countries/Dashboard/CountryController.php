<?php

namespace App\Http\Controllers\Countries\Dashboard;

use App\Models\Country;
use Illuminate\Routing\Controller;
use App\Http\Requests\Countries\CountryRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CountryController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * CountryController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Country::class, 'country');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::filter()->paginate();

        return view('dashboard.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Countries\CountryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CountryRequest $request)
    {
        $country = Country::create($request->all());

        $country->addAllMediaFromTokens();

        flash(trans('countries.messages.created'));

        return redirect()->route('dashboard.countries.show', $country);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        $cities = $country->cities()->filter()->paginate();

        return view('dashboard.countries.show', compact('country', 'cities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        return view('dashboard.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Countries\CountryRequest $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->all());

        $country->addAllMediaFromTokens();

        flash(trans('countries.messages.updated'));

        return redirect()->route('dashboard.countries.show', $country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Country $country
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Country $country)
    {
        $country->delete();

        flash(trans('countries.messages.deleted'));

        return redirect()->route('dashboard.countries.index');
    }
}
