@can('create', \App\Models\Page::class)
    <a href="{{ route('dashboard.pages.create') }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('pages.actions.create')
    </a>
@endcan
