@can('view', $brand)
    <a href="{{ route('dashboard.brands.show', $brand) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@endcan
