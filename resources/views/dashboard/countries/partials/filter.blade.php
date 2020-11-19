{{ BsForm::resource('countries')->get(url()->current()) }}
@component('dashboard::components.box')
    @slot('title', trans('countries.filter'))

    <div class="row">
        <div class="col-md-3">
            {{ BsForm::text('name')->value(request('name')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('code')->value(request('code')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('key')->value(request('key')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('countries.perPage')) }}
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('countries.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
