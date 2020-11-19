@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Currency::class])
    @slot('url', route('dashboard.currencies.index'))
    @slot('name', trans('currencies.plural'))
    @slot('active', request()->routeIs('*currencies*'))
    @slot('icon', 'fas fa-money')
    @slot('tree', [
        [
            'name' => trans('currencies.actions.list'),
            'url' => route('dashboard.currencies.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Currency::class],
            'active' => request()->routeIs('*currencies.index')
            || request()->routeIs('*currencies.show')
            || request()->routeIs('*currencies.cities*'),
        ],
        [
            'name' => trans('currencies.actions.create'),
            'url' => route('dashboard.currencies.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Currency::class],
            'active' => request()->routeIs('*currencies.create'),
        ],
    ])
@endcomponent
