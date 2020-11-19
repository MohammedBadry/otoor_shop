@component('dashboard::components.sidebarItem')
    @slot('url', route('dashboard.settings.index'))
    @slot('name', trans('settings.plural'))
    @slot('active', request()->routeIs('*settings.index'))
    @slot('icon', 'fas fa-cogs')
@endcomponent
