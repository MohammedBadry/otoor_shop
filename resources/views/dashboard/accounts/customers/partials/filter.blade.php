{{ BsForm::resource('customers')->get(url()->current()) }}
@component('dashboard::components.box')
    @slot('title', trans('customers.actions.filter'))

    <div class="row">
        <div class="col-md-3">
            {{ BsForm::text('name')->value(request('name')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('email')->value(request('email')) }}
        </div>
        <div class="col-md-3">
            {{ BsForm::text('phone')->value(request('phone')) }}
        </div>
        <div class="col-md-3">
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
            @lang('customers.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}
