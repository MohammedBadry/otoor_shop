<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    use AuthorizesRequests;
    use ValidatesRequests;

    public function index()
    {
        return view('cart');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'qty' => 'required|numeric',
            'item_id' => 'required',
            'item_type' => 'required',
        ]);

        $cart = session('cart', []);

        $cart[$request->item_type.$request->item_id] = [
            'item_id' => $request->item_id,
            'item_type' => $request->item_type,
            'size_id' => $request->size_id,
            'qty' => $request->qty,
        ];

        session()->put('cart', $cart);

        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cart = [];

        foreach ($request->cart as $item) {
            $type = $item['item_type'];
            if ($product = $type::find($item['item_id'])) {
                $cart[$product->getMorphClass().$product->id]['item_id'] = $product->id;
                $cart[$product->getMorphClass().$product->id]['item_type'] = $product->getMorphClass();
                $cart[$product->getMorphClass().$product->id]['qty'] = (int) $item['qty'] ?? 1;
            }
        }

        session()->put('cart', $cart);

        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->item_type.$request->item_id;

        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart = Arr::except($cart, $id);
        }

        session()->put('cart', $cart);

        return back();
    }
}
