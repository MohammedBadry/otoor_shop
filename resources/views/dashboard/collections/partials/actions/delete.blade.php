@can('delete', $collection)
<a href="#collection-{{ $collection->id }}-delete-model"
   class="btn btn-outline-danger btn-sm"
   data-toggle="modal">
  <i class="fas fa fa-fw fa-trash"></i>
</a>


<!-- Modal -->
<div class="modal fade" id="collection-{{ $collection->id }}-delete-model" tabindex="-1" role="dialog"
     aria-labelledby="modal-title-{{ $collection->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title-{{ $collection->id }}">@lang('collections.dialogs.delete.title')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @lang('collections.dialogs.delete.info')
      </div>
      <div class="modal-footer">
        {{ BsForm::delete(route('dashboard.collections.destroy', $collection)) }}
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          @lang('collections.dialogs.delete.cancel')
        </button>
        <button type="submit" class="btn btn-danger">
          @lang('collections.dialogs.delete.confirm')
        </button>
        {{ BsForm::close() }}
      </div>
    </div>
  </div>
</div>
@endcan
