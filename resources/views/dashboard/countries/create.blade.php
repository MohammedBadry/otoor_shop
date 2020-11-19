<x-layout :title="trans('countries.actions.create')" :breadcrumbs="['dashboard.countries.create']">
    {{ BsForm::resource('countries')->post(route('dashboard.countries.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('countries.actions.create'))

        @include('dashboard.countries.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('countries.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>