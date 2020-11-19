<?php

namespace App\Http\Controllers\Products\Dashboard;

use App\Models\Product;
use App\Models\CustomField;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\Products\ProductRequest;
use App\Http\Requests\Categories\CategoryRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Product ::class, 'product');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::filter()
            ->whereHas('category', function (Builder $builder) {
                $builder->where('country_id', request('country_id', country()->id));
            })
            ->paginate();

        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Products\ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());

        foreach ($request->input('sizes', []) as $size) {
            $product->sizes()->create($size);
        }

        $product->addAllMediaFromTokens();

        flash(trans('products.messages.created'));

        return redirect()->route('dashboard.products.show', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $offers = $product->offers()->paginate();

        return view('dashboard.products.show', compact('product', 'offers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $sizes = $product->sizes->map(function ($size) {
            return [
               'name' => $size->name,
               'price' => $size->price,
           ];
        });

        return view('dashboard.products.edit', compact('product', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Products\ProductRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());

        $product->sizes()->delete();
        foreach ($request->input('sizes', []) as $size) {
            $product->sizes()->create($size);
        }

        $product->addAllMediaFromTokens();

        flash(trans('products.messages.updated'));

        return redirect()->route('dashboard.products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        flash(trans('products.messages.deleted'));

        return redirect()->route('dashboard.products.index');
    }
}
