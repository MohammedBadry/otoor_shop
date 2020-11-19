@can('create', \App\Models\Tester::class)
    <a href="{{ route('dashboard.testers.create') }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('testers.actions.create')
    </a>
@endcan
