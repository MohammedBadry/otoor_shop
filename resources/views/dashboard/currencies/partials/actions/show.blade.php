@can('view', $currency)
    <a href="{{ route('dashboard.currencies.show', $currency) }}" class="btn btn-outline-dark btn-sm">
        <i class="fas fa fa-fw fa-eye"></i>
    </a>
@endcan
