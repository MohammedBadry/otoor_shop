<x-layout :title="trans('sizes.actions.create')" :breadcrumbs="['dashboard.sizes.create']">
    {{ BsForm::resource('sizes')->post(route('dashboard.sizes.store')) }}
    @component('dashboard::components.box')
        @slot('title', trans('sizes.actions.create'))

        @include('dashboard.sizes.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('sizes.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>