
@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Order::class])
    @slot('url', route('dashboard.orders.index'))
    @slot('name', trans('orders.plural'))
    @slot('active', request()->routeIs('*orders*'))
    @slot('icon', 'fas fa-ad')
    @slot('tree', [
        [
            'name' => trans('orders.actions.list'),
            'url' => route('dashboard.orders.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Order::class],
            'active' => request()->routeIs('*orders.index')
            && ! request()->query('status'),
        ],
        [
            'name' => trans('orders.statuses.'. $status = \App\Models\Order::PENDING),
            'url' => route('dashboard.orders.index', compact('status')),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Order::class],
            'active' => request()->routeIs('*orders.index')
            && request()->query('status') == $status,
        ],
        [
            'name' => trans('orders.statuses.'. $status = \App\Models\Order::IN_PROGRESS),
            'url' => route('dashboard.orders.index', compact('status')),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Order::class],
            'active' => request()->routeIs('*orders.index')
            && request()->query('status') == $status,
        ],
        [
            'name' => trans('orders.statuses.'. $status = \App\Models\Order::REJECTED),
            'url' => route('dashboard.orders.index', compact('status')),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Order::class],
            'active' => request()->routeIs('*orders.index')
            && request()->query('status') == $status,
        ],
        [
            'name' => trans('orders.statuses.'. $status = \App\Models\Order::CANCELED),
            'url' => route('dashboard.orders.index', compact('status')),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Order::class],
            'active' => request()->routeIs('*orders.index')
            && request()->query('status') == $status,
        ],
        [
            'name' => trans('orders.statuses.'. $status = \App\Models\Order::DELIVERED),
            'url' => route('dashboard.orders.index', compact('status')),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Order::class],
            'active' => request()->routeIs('*orders.index')
            && request()->query('status') == $status,
        ],
    ])
@endcomponent
