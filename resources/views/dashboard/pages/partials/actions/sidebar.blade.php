@component('dashboard::components.sidebarItem')
    @slot('can', ['ability' => 'viewAny', 'model' => \App\Models\Page::class])
    @slot('url', route('dashboard.pages.index'))
    @slot('name', trans('pages.plural'))
    @slot('active', request()->routeIs('*pages*'))
    @slot('icon', 'fas fa-th')
    @slot('tree', [
        [
            'name' => trans('pages.actions.list'),
            'url' => route('dashboard.pages.index'),
            'can' => ['ability' => 'viewAny', 'model' => \App\Models\Page::class],
            'active' => request()->routeIs('*pages.index')
            || request()->routeIs('*pages.show')
            || request()->routeIs('*pages.cities*'),
        ],
        [
            'name' => trans('pages.actions.create'),
            'url' => route('dashboard.pages.create'),
            'can' => ['ability' => 'create', 'model' => \App\Models\Page::class],
            'active' => request()->routeIs('*pages.create'),
        ],
    ])
@endcomponent
