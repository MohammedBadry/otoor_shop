@include('dashboard.cities.partials.filter')

@component('dashboard::components.table-box')
    @slot('title', trans('cities.actions.list'))
    @slot('bodyClass', 'p-0')
    <thead>
    <tr>
        <th>@lang('cities.attributes.name')</th>
        <th>@lang('cities.attributes.shipping_price')</th>

        <th style="width: 160px">...</th>
    </tr>
    </thead>
    <tbody>
    @forelse($cities as $city)
        <tr>
            <td>{{ $city->name }}</td>
            <td>
                <span class="badge badge-success">
                    {{ $city->getShippingPrice() }}
                </span>
            </td>


            <td style="width: 160px">
                @include('dashboard.cities.partials.actions.edit')
                @include('dashboard.cities.partials.actions.delete')
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="100" class="text-center">@lang('cities.empty')</td>
        </tr>
    @endforelse

    @if($cities->hasPages())
        @slot('footer')
            {{ $cities->links() }}
        @endslot
    @endif
@endcomponent
