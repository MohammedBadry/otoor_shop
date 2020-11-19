<x-layout :title="$country->name" :breadcrumbs="['dashboard.countries.edit', $country]">
    {{ BsForm::resource('countries')->putModel($country, route('dashboard.countries.update', $country)) }}
    @component('dashboard::components.box')
        @slot('title', trans('countries.actions.edit'))

        @include('dashboard.countries.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('countries.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>