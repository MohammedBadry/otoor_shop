<x-layout :title="trans('dashboard.home')" :breadcrumbs="['dashboard.home']">

    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon"><i class="icon fas fa-users fa-3x"></i>
                <div class="info">
                    <h4>@lang('customers.count')</h4>
                    <p><b><a href="{{ route('dashboard.customers.index') }}">{{ number_format($customersCount) }}</a></b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small info coloured-icon"><i class="icon fas fa-flag fa-3x"></i>
                <div class="info">
                    <h4>@lang('categories.count')</h4>
                    <p><b><a href="{{ route('dashboard.categories.index') }}">{{ number_format($categoriesCount) }}</a></b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
                <div class="info">
                    <h4>@lang('products.count')</h4>
                    <p><b><a href="{{ route('dashboard.products.index') }}">{{ number_format($productsCount) }}</a></b></p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h5 class="mb-4">@lang('orders.statistics')</h5>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small warning coloured-icon"><i class="icon fas fa-cogs fa-3x"></i>
                <div class="info">
                    <h4>@lang('orders.statuses.'. $status = \App\Models\Order::PENDING)</h4>
                    <p><b><a href="{{ route('dashboard.orders.index', ['status' => $status]) }}">{{ number_format($pendingCount) }}</a></b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon"><i class="icon fas fa-refresh fa-3x"></i>
                <div class="info">
                    <h4>@lang('orders.statuses.'. $status = \App\Models\Order::IN_PROGRESS)</h4>
                    <p><b><a href="{{ route('dashboard.orders.index', ['status' => $status]) }}">{{ number_format($inProgressCount) }}</a></b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small danger coloured-icon"><i class="icon fas fa-times fa-3x"></i>
                <div class="info">
                    <h4>@lang('orders.statuses.'. $status = \App\Models\Order::REJECTED)</h4>
                    <p><b><a href="{{ route('dashboard.orders.index', ['status' => $status]) }}">{{ number_format($rejectedCount) }}</a></b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small danger coloured-icon"><i class="icon fas fa-times fa-3x"></i>
                <div class="info">
                    <h4>@lang('orders.statuses.'. $status = \App\Models\Order::CANCELED)</h4>
                    <p><b><a href="{{ route('dashboard.orders.index', ['status' => $status]) }}">{{ number_format($canceledCount) }}</a></b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon"><i class="icon fas fa-check fa-3x"></i>
                <div class="info">
                    <h4>@lang('orders.statuses.'. $status = \App\Models\Order::DELIVERED)</h4>
                    <p><b><a href="{{ route('dashboard.orders.index', ['status' => $status]) }}">{{ number_format($deliveredCount) }}</a></b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon"><i class="icon fas fa-money fa-3x"></i>
                <div class="info">
                    <h4>@lang('orders.earnings')</h4>
                    <p><b><a href="{{ route('dashboard.orders.index', ['status' => $status]) }}">{{ price($earnings) }}</a></b></p>
                </div>
            </div>
        </div>
    </div>

</x-layout>
