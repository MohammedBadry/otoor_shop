<x-layout :title="trans('testers.actions.create')" :breadcrumbs="['dashboard.testers.create']">
    {{ BsForm::resource('testers')->post(route('dashboard.testers.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('testers.actions.create'))

        @include('dashboard.testers.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('testers.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>