@can('create', \App\Models\Collection::class)
    <a href="{{ route('dashboard.collections.create') }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('collections.actions.create')
    </a>
@endcan
