{{ BsForm::resource('cities')->post(route('dashboard.countries.cities.store', $country)) }}
@component('dashboard::components.box')
    @slot('title', trans('cities.actions.create'))

    @include('dashboard.cities.partials.form', ['countryId' => $countryId ?? null])

    @slot('footer')
        {{ BsForm::submit()->label(trans('cities.actions.save')) }}
    @endslot
@endcomponent
{{ BsForm::close() }}
