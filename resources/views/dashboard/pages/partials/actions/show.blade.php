@can('view', $page)
    <a href="{{ route('dashboard.pages.show', $page) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@endcan
