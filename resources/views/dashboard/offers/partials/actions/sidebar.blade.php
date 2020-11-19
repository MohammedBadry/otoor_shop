@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Offer::class])
    @slot('url', route('dashboard.offers.index'))
    @slot('name', trans('offers.plural'))
    @slot('active', request()->routeIs('*offers*'))
    @slot('icon', 'fas fa-shopping-cart')
    @slot('tree', [
        [
            'name' => trans('offers.actions.list'),
            'url' => route('dashboard.offers.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Offer::class],
            'active' => request()->routeIs('*offers.index')
            || request()->routeIs('*offers.show'),
        ],
        [
            'name' => trans('offers.actions.create'),
            'url' => route('dashboard.offers.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Offer::class],
            'active' => request()->routeIs('*offers.create'),
        ],
    ])
@endcomponent
