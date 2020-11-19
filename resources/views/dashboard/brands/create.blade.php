<x-layout :title="trans('brands.actions.create')" :breadcrumbs="['dashboard.brands.create']">
    {{ BsForm::resource('brands')->post(route('dashboard.brands.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('brands.actions.create'))

        @include('dashboard.brands.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('brands.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>