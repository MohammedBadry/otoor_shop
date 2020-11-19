<?php

namespace App\Http\Controllers\Currencies\Dashboard;

use App\Models\Currency;
use Illuminate\Routing\Controller;
use App\Http\Requests\Currencies\CurrencyRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CurrencyController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * CurrencyController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Currency::class, 'currency');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::filter()->paginate();

        return view('dashboard.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.currencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Currencies\CurrencyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CurrencyRequest $request)
    {
        $currency = Currency::create($request->all());

        flash(trans('currencies.messages.created'));

        return redirect()->route('dashboard.currencies.show', $currency);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        $otherCurrencies = Currency::where('id', '!=', $currency->id)->get();

        return view('dashboard.currencies.show', compact('currency', 'otherCurrencies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Currency $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view('dashboard.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Currencies\CurrencyRequest $request
     * @param \App\Models\Currency $currency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CurrencyRequest $request, Currency $currency)
    {
        $currency->update($request->all());

        flash(trans('currencies.messages.updated'));

        return redirect()->route('dashboard.currencies.show', $currency);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Currency $currency
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Currency $currency)
    {
        $currency->delete();

        flash(trans('currencies.messages.deleted'));

        return redirect()->route('dashboard.currencies.index');
    }
}
