<?php

namespace App\Http\Controllers\Offers\Dashboard;

use App\Http\Requests\Offers\OfferRequest;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Offer;
use App\Models\CustomField;
use App\Models\Product;
use App\Models\Tester;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OfferController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * OfferController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Offer::class, 'offer');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Offers\OfferRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OfferRequest $request)
    {
        $offer = Offer::create($request->all());

        flash(trans('offers.messages.created'));

        // TODO: refactor.
        if ($offer->target instanceof Product) {
            return redirect()->route('dashboard.products.show', $offer->target);
        }
        if ($offer->target instanceof Category) {
            return redirect()->route('dashboard.categories.show', $offer->target);
        }
        if ($offer->target instanceof Collection) {
            return redirect()->route('dashboard.collections.show', $offer->target);
        }
        if ($offer->target instanceof Tester) {
            return redirect()->route('dashboard.testers.show', $offer->target);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        return view('dashboard.offers.edit', compact('offer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Offers\OfferRequest $request
     * @param \App\Models\Offer $offer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OfferRequest $request, Offer $offer)
    {
        $offer->update($request->all());

        flash(trans('offers.messages.updated'));

        // TODO: refactor.
        if ($offer->target instanceof Product) {
            return redirect()->route('dashboard.products.show', $offer->target);
        }
        if ($offer->target instanceof Category) {
            return redirect()->route('dashboard.categories.show', $offer->target);
        }
        if ($offer->target instanceof Collection) {
            return redirect()->route('dashboard.collections.show', $offer->target);
        }
        if ($offer->target instanceof Tester) {
            return redirect()->route('dashboard.testers.show', $offer->target);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Offer $offer
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();

        flash(trans('offers.messages.deleted'));

        return back();
    }
}
