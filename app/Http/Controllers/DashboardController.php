<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customersCount = Customer::count();
        $categoriesCount = Category::count();
        $productsCount = Product::count();

        $ordersCount = Order::count();
        $pendingCount = Order::where('status', Order::PENDING)->count();
        $inProgressCount = Order::where('status', Order::IN_PROGRESS)->count();
        $canceledCount = Order::where('status', Order::CANCELED)->count();
        $rejectedCount = Order::where('status', Order::REJECTED)->count();
        $deliveredCount = Order::where('status', Order::DELIVERED)->count();
        $earnings = Order::where('status', Order::DELIVERED)->sum('total');

        return view('dashboard.home', get_defined_vars());
    }
}
