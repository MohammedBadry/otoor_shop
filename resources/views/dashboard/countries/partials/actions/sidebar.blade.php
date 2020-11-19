@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Country::class])
    @slot('url', route('dashboard.countries.index'))
    @slot('name', trans('countries.plural'))
    @slot('active', request()->routeIs('*countries*'))
    @slot('icon', 'fas fa-flag')
    @slot('tree', [
        [
            'name' => trans('countries.actions.list'),
            'url' => route('dashboard.countries.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Country::class],
            'active' => request()->routeIs('*countries.index')
            || request()->routeIs('*countries.show')
            || request()->routeIs('*countries.cities*'),
        ],
        [
            'name' => trans('countries.actions.create'),
            'url' => route('dashboard.countries.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Country::class],
            'active' => request()->routeIs('*countries.create'),
        ],
    ])
@endcomponent
