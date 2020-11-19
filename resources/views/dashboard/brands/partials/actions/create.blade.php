@can('create', \App\Models\Brand::class)
    <a href="{{ route('dashboard.brands.create') }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('brands.actions.create')
    </a>
@endcan
