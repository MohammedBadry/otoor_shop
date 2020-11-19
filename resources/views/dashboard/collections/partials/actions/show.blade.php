@can('view', $collection)
    <a href="{{ route('dashboard.collections.show', $collection) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@endcan
