@can('create', \App\Models\Size::class)
    <a href="{{ route('dashboard.sizes.create') }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('sizes.actions.create')
    </a>
@endcan
