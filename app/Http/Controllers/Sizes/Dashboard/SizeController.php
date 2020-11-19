<?php

namespace App\Http\Controllers\Sizes\Dashboard;

use App\Models\Size;
use Illuminate\Routing\Controller;
use App\Http\Requests\Sizes\SizeRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SizeController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * SizeController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Size::class, 'size');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::filter()->paginate();

        return view('dashboard.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Sizes\SizeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SizeRequest $request)
    {
        $size = Size::create($request->all());

        flash(trans('sizes.messages.created'));

        return redirect()->route('dashboard.sizes.show', $size);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Size $size
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        return view('dashboard.sizes.show', compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Size $size
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        return view('dashboard.sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Sizes\SizeRequest $request
     * @param \App\Models\Size $size
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SizeRequest $request, Size $size)
    {
        $size->update($request->all());

        flash(trans('sizes.messages.updated'));

        return redirect()->route('dashboard.sizes.show', $size);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Size $size
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Size $size)
    {
        $size->delete();

        flash(trans('sizes.messages.deleted'));

        return redirect()->route('dashboard.sizes.index');
    }
}
