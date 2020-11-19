<x-layout :title="'#'.$order->id" :breadcrumbs="['dashboard.orders.show', $order]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('orders.attributes.id')</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.user_id')</th>
                        <td>{{ optional($order->customer)->name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.name')</th>
                        <td>{{ $order->name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.phone')</th>
                        <td>{{ $order->phone }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.city')</th>
                        <td>{{ $order->city }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.area')</th>
                        <td>{{ $order->area }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.street')</th>
                        <td>{{ $order->street }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.address')</th>
                        <td>{{ $order->address }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.status')</th>
                        <td>@lang('orders.statuses.'.$order->status)</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.total')</th>
                        <td>{{ price($order->total) }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.paid')</th>
                        <td>{{ price($order->paid) }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.payment_method')</th>
                        <td>@lang('orders.payment_methods.'.$order->payment_method)</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('orders.attributes.gift_message')</th>
                        <td>{{ $order->gift_message }}</td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.orders.partials.actions.edit')
                    @include('dashboard.orders.partials.actions.delete')
                @endslot
            @endcomponent
        </div>
        <div class="col-md-6">
            @component('dashboard::components.table-box')
                <thead>
                <tr>
                    <th>@lang('products.attributes.name')</th>
                    <th class="d-none d-md-table-cell">@lang('products.attributes.price')</th>
                    <th class="d-none d-md-table-cell">@lang('orders.attributes.qty')</th>
                    <th class="d-none d-md-table-cell">@lang('orders.attributes.total')</th>
                </tr>
                </thead>
                <tbody>
                @forelse($order->items as $orderItem)
                    @php($item = $orderItem->item)
                    <tr>
                        <td>
                            <a href="{{ $item->getDashboardUrl() }}"
                               class="text-decoration-none text-ellipsis">
                                <img src="{{ $item->getFirstMediaUrl('default', 'thumb') }}"
                                     alt="{{ $item->name }}"
                                     class="img-size-32 mr-2">
                                {{ $item->name }}
                            </a>
                        </td>
                        <td>{{ price($item->price) }}</td>
                        <td>{{ $orderItem->qty }}</td>
                        <td>{{ price($orderItem->total) }}</td>
                @empty
                    <tr>
                        <td colspan="100" class="text-center">@lang('products.empty')</td>
                    </tr>
                @endforelse
            @endcomponent
        </div>
    </div>
</x-layout>
