@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Collection::class])
    @slot('url', route('dashboard.collections.index'))
    @slot('name', trans('collections.plural'))
    @slot('active', request()->routeIs('*collections*'))
    @slot('icon', 'fas fa-th')
    @slot('tree', [
        [
            'name' => trans('collections.actions.list'),
            'url' => route('dashboard.collections.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Collection::class],
            'active' => request()->routeIs('*collections.index')
            || request()->routeIs('*collections.show')
            || request()->routeIs('*collections.cities*'),
        ],
        [
            'name' => trans('collections.actions.create'),
            'url' => route('dashboard.collections.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Collection::class],
            'active' => request()->routeIs('*collections.create'),
        ],
    ])
@endcomponent
