<x-layout :title="trans('collections.actions.create')" :breadcrumbs="['dashboard.collections.create']">
    {{ BsForm::resource('collections')->post(route('dashboard.collections.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('collections.actions.create'))

        @include('dashboard.collections.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('collections.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>