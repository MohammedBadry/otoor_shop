<?php

namespace App\Http\Controllers\Accounts\Dashboard;

use App\Models\Customer;
use App\Models\User;
use App\Support\Accounts\AccountFactory;
use Illuminate\Routing\Controller;
use App\Http\Requests\Accounts\CustomerRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CustomerController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Customer::class, 'customer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index()
    {
        $customers = Customer::filter()->paginate();

        return view('dashboard.accounts.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.accounts.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Accounts\CustomerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->allWithHashedPassword());

        $customer->setType($request->type);

        $customer->addAllMediaFromTokens();

        flash(trans('customers.messages.created'));

        return redirect()->route('dashboard.customers.show', $customer);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $addresses = $customer->addresses()->with('city')->paginate();

        return view('dashboard.accounts.customers.show', compact('customer', 'addresses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.accounts.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Accounts\CustomerRequest $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->allWithHashedPassword());

        $customer->setType($request->type);

        $customer->addAllMediaFromTokens();

        flash(trans('customers.messages.updated'));

        return redirect()->route('dashboard.customers.show', $customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        flash(trans('customers.messages.deleted'));

        return redirect()->route('dashboard.customers.index');
    }
}
