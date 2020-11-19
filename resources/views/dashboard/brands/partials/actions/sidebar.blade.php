@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Brand::class])
    @slot('url', route('dashboard.brands.index'))
    @slot('name', trans('brands.plural'))
    @slot('active', request()->routeIs('*brands*'))
    @slot('icon', 'fas fa-ad')
    @slot('tree', [
        [
            'name' => trans('brands.actions.list'),
            'url' => route('dashboard.brands.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Brand::class],
            'active' => request()->routeIs('*brands.index')
            || request()->routeIs('*brands.show')
            || request()->routeIs('*brands.cities*'),
        ],
        [
            'name' => trans('brands.actions.create'),
            'url' => route('dashboard.brands.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Brand::class],
            'active' => request()->routeIs('*brands.create'),
        ],
    ])
@endcomponent
