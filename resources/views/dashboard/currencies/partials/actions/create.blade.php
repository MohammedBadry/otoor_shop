@can('create', \App\Models\Currency::class)
    <a href="{{ route('dashboard.currencies.create') }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('currencies.actions.create')
    </a>
@endcan
