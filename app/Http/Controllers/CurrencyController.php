<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Currency;
use Illuminate\Routing\Controller;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Currency $currency
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(Currency $currency)
    {
        session()->put('currency', $currency->code);

        return back();
    }
}
