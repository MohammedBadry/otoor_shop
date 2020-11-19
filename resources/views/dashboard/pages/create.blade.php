<x-layout :title="trans('pages.actions.create')" :breadcrumbs="['dashboard.pages.create']">
    {{ BsForm::resource('pages')->post(route('dashboard.pages.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('pages.actions.create'))

        @include('dashboard.pages.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('pages.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>