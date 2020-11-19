@can('create', \App\Models\Offer::class)
    <a href="{{ route('dashboard.offers.create', ['target_type' => get_class($target), 'target_id' => $target->id]) }}" class="btn btn-outline-success btn-sm">
        <i class="fas fa fa-fw fa-plus"></i>
        @lang('offers.actions.create')
    </a>
@endcan
