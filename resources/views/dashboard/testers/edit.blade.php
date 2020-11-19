<x-layout :title="$tester->name" :breadcrumbs="['dashboard.testers.edit', $tester]">
    {{ BsForm::resource('testers')->putModel($tester, route('dashboard.testers.update', $tester)) }}
    @component('dashboard::components.box')
        @slot('title', trans('testers.actions.edit'))

        @include('dashboard.testers.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('testers.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>