<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Country;
use App\Models\Product;
use App\Models\Tester;
use App\Support\Cache\CacheFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Routing\Controller;
use Laraeast\LaravelSettings\Facades\Settings;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Country|null $country
     * @return \Illuminate\Http\Response
     */
    public function index(Country $country = null)
    {
        $country = $country ?: Country::default()->firstOrFail();

        $categories = Category::where('country_id', $country->id)->pluck('id');

        $products = Product::filter()->whereIn('category_id', $categories);
        $bestSellerProducts = (clone $products)->paginate();
        $featuredProducts = (clone $products)->paginate();
        $latestProducts = (clone $products)->latest()->limit(3)->paginate();
        $collections = Collection::latest()->paginate();
        $testers = Tester::latest()->paginate();

        $slider = optional(Settings::instance('slider'))->getMedia('slider') ?: collect();

        return view('home', get_defined_vars());
    }
}
