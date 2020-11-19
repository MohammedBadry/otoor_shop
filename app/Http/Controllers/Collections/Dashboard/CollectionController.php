<?php

namespace App\Http\Controllers\Collections\Dashboard;

use App\Models\Collection;
use Illuminate\Routing\Controller;
use App\Http\Requests\Collections\CollectionRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CollectionController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * CollectionController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Collection::class, 'collection');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::filter()->paginate();

        return view('dashboard.collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.collections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Collections\CollectionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CollectionRequest $request)
    {
        $collection = Collection::create($request->all());

        $collection->addAllMediaFromTokens();

        $collection->products()->sync($request->products);

        flash(trans('collections.messages.created'));

        return redirect()->route('dashboard.collections.show', $collection);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        $offers = $collection->offers()->paginate();

        return view('dashboard.collections.show', compact('collection', 'offers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        return view('dashboard.collections.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Collections\CollectionRequest $request
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CollectionRequest $request, Collection $collection)
    {
        $collection->update($request->all());

        $collection->addAllMediaFromTokens();

        $collection->products()->sync($request->products);

        flash(trans('collections.messages.updated'));

        return redirect()->route('dashboard.collections.show', $collection);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Collection $collection
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();

        flash(trans('collections.messages.deleted'));

        return redirect()->route('dashboard.collections.index');
    }
}
