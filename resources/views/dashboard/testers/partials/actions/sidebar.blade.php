@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Tester::class])
    @slot('url', route('dashboard.testers.index'))
    @slot('name', trans('testers.plural'))
    @slot('active', request()->routeIs('*testers*'))
    @slot('icon', 'fas fa-th')
    @slot('tree', [
        [
            'name' => trans('testers.actions.list'),
            'url' => route('dashboard.testers.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Tester::class],
            'active' => request()->routeIs('*testers.index')
            || request()->routeIs('*testers.show')
            || request()->routeIs('*testers.cities*'),
        ],
        [
            'name' => trans('testers.actions.create'),
            'url' => route('dashboard.testers.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Tester::class],
            'active' => request()->routeIs('*testers.create'),
        ],
    ])
@endcomponent
