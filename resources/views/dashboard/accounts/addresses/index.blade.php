<div class="row">
    <div class="col-md-4">
        {{ BsForm::resource('addresses')
            ->post(route('dashboard.customers.addresses.store', $customer)) }}
        @component('dashboard::components.box')
            @slot('title', trans('addresses.actions.create'))

            @include('dashboard.accounts.addresses.partials.form')

            @slot('footer')
                {{ BsForm::submit()->label(trans('addresses.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}
    </div>
    <div class="col-md-8">
        @component('dashboard::components.table-box')

            @slot('title', trans('addresses.actions.list'))

            <thead>
            <tr>
                <th>@lang('addresses.attributes.address')</th>
                <th>@lang('addresses.attributes.city_id')</th>
                <th style="width: 160px">...</th>
            </tr>
            </thead>
            <tbody>
            @forelse($addresses as $address)
                <tr>
                    <td>{{ $address->address }}</td>
                    <td>{{ $address->city->name }}</td>
                    <td style="width: 160px">
                        @include('dashboard.accounts.addresses.partials.actions.edit')
                        @include('dashboard.accounts.addresses.partials.actions.delete')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100" class="text-center">@lang('addresses.empty')</td>
                </tr>
            @endforelse

            @if($addresses->hasPages())
                @slot('footer')
                    {{ $addresses->links() }}
                @endslot
            @endif
        @endcomponent
    </div>
</div>