<?php

namespace App\Http\Controllers\Brands\Dashboard;

use App\Models\Brand;
use Illuminate\Routing\Controller;
use App\Http\Requests\Brands\BrandRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BrandController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * BrandController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Brand::class, 'brand');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::filter()->paginate();

        return view('dashboard.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Brands\BrandRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BrandRequest $request)
    {
        $brand = Brand::create($request->all());

        $brand->addAllMediaFromTokens();

        flash(trans('brands.messages.created'));

        return redirect()->route('dashboard.brands.show', $brand);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('dashboard.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Brands\BrandRequest $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $brand->update($request->all());

        $brand->addAllMediaFromTokens();

        flash(trans('brands.messages.updated'));

        return redirect()->route('dashboard.brands.show', $brand);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Brand $brand
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        flash(trans('brands.messages.deleted'));

        return redirect()->route('dashboard.brands.index');
    }
}
