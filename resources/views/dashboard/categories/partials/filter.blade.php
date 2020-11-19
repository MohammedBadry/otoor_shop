{{ BsForm::resource('categories')->get(url()->current()) }}
@component('dashboard::components.box')
    @slot('title', trans('categories.filter'))

    <div class="row">
        <div class="col-md-4">
            {{ BsForm::text('name')->value(request('name')) }}
        </div>
        <div class="col-md-4">
            {{ BsForm::number('perPage')
                ->value(request('perPage', 15))
                ->min(1)
                 ->label(trans('categories.perPage')) }}
        </div>
        <div class="col-md-4">
            <select2
                    name="country_id"
                    label="@lang('countries.singular')"
                    placeholder="@lang('countries.select')"
                    remote-url="{{ route('countries.select') }}"
                    value="{{ request('country_id', country()->id) }}"
            ></select2>
        </div>
    </div>

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('categories.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
