@can('create', \App\Models\Country::class)
    <a href="{{ route('dashboard.countries.create') }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('countries.actions.create')
    </a>
@endcan
