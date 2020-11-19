{{ BsForm::resource('currencies')->get(url()->current()) }}
@component('dashboard::components.box')
    @slot('title', trans('currencies.filter'))

    <div class="row">
        <div class="col-md-4">
            {{ BsForm::text('name')->value(request('name')) }}
        </div>
        <div class="col-md-4">
            {{ BsForm::text('code')->value(request('code')) }}
        </div>
        <div class="col-md-4">
            {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('currencies.perPage')) }}
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('currencies.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
