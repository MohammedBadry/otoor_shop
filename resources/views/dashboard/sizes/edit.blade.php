<x-layout :title="$size->name" :breadcrumbs="['dashboard.sizes.edit', $size]">
    {{ BsForm::resource('sizes')->putModel($size, route('dashboard.sizes.update', $size)) }}
    @component('dashboard::components.box')
        @slot('title', trans('sizes.actions.edit'))

        @include('dashboard.sizes.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('sizes.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>