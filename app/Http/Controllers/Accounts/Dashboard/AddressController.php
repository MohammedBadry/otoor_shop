<?php

namespace App\Http\Controllers\Accounts\Dashboard;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Routing\Controller;
use App\Http\Requests\Accounts\AddressRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AddressController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * AddressController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Address::class, 'address');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Accounts\AddressRequest $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddressRequest $request, Customer $customer)
    {
        $customer->addresses()->create($request->all());

        flash(trans('addresses.messages.created'));

        return redirect()->route('dashboard.customers.show', $customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer, Address $address)
    {
        return view('dashboard.accounts.addresses.edit', compact('customer', 'address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Accounts\AddressRequest $request
     * @param \App\Models\Customer $customer
     * @param \App\Models\Address $address
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AddressRequest $request, Customer $customer, Address $address)
    {
        $address->update($request->all());

        flash(trans('addresses.messages.updated'));

        return redirect()->route('dashboard.customers.show', $customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Customer $customer
     * @param \App\Models\Address $address
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Customer $customer, Address $address)
    {
        $address->delete();

        flash(trans('addresses.messages.deleted'));

        return redirect()->route('dashboard.customers.show', $customer);
    }
}
