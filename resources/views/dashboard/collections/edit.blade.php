<x-layout :title="$collection->name" :breadcrumbs="['dashboard.collections.edit', $collection]">
    {{ BsForm::resource('collections')->putModel($collection, route('dashboard.collections.update', $collection)) }}
    @component('dashboard::components.box')
        @slot('title', trans('collections.actions.edit'))

        @include('dashboard.collections.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('collections.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>