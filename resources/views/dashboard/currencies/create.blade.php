<x-layout :title="trans('currencies.actions.create')" :breadcrumbs="['dashboard.currencies.create']">
    {{ BsForm::resource('currencies')->post(route('dashboard.currencies.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('currencies.actions.create'))

        @include('dashboard.currencies.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('currencies.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>