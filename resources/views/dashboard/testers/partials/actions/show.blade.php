@can('view', $tester)
    <a href="{{ route('dashboard.testers.show', $tester) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@endcan
