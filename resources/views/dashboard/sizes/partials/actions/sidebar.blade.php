@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Size::class])
    @slot('url', route('dashboard.sizes.index'))
    @slot('name', trans('sizes.plural'))
    @slot('active', request()->routeIs('*sizes*'))
    @slot('icon', 'fas fa-th')
    @slot('tree', [
        [
            'name' => trans('sizes.actions.list'),
            'url' => route('dashboard.sizes.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Size::class],
            'active' => request()->routeIs('*sizes.index')
            || request()->routeIs('*sizes.show')
            || request()->routeIs('*sizes.cities*'),
        ],
        [
            'name' => trans('sizes.actions.create'),
            'url' => route('dashboard.sizes.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Size::class],
            'active' => request()->routeIs('*sizes.create'),
        ],
    ])
@endcomponent
