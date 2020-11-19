<x-layout :title="$address->name" :breadcrumbs="['dashboard.customers.addresses.edit', $customer, $address]">
    {{ BsForm::resource('addresses')->putModel($address, route('dashboard.customers.addresses.update', [$customer, $address])) }}
    @component('dashboard::components.box')
        @slot('title', trans('addresses.actions.edit'))

        @include('dashboard.accounts.addresses.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('addresses.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>