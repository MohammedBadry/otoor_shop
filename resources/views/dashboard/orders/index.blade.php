<x-layout :title="trans('orders.plural')" :breadcrumbs="['dashboard.orders.index']">
    @component('dashboard::components.table-box')
        @slot('title', trans('orders.actions.list'))

        <thead>
        <tr>
            <th>@lang('orders.attributes.id')</th>
            <th>@lang('orders.attributes.city')</th>
            <th>@lang('orders.attributes.total')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr>
                <td>
                    <a href="{{ route('dashboard.orders.show', $order) }}"
                       class="text-decoration-none text-ellipsis">
                        #{{ $order->id }}
                    </a>
                </td>
                <td>{{ $order->city }}</td>
                <td>{{ price($order->total) }}</td>

                <td style="width: 160px">
                    @include('dashboard.orders.partials.actions.show')
                    @include('dashboard.orders.partials.actions.edit')
                    @include('dashboard.orders.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('orders.empty')</td>
            </tr>
        @endforelse

        @if($orders->hasPages())
            @slot('footer')
                {{ $orders->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
