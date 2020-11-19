<x-layout :title="$brand->name" :breadcrumbs="['dashboard.brands.edit', $brand]">
    {{ BsForm::resource('brands')->putModel($brand, route('dashboard.brands.update', $brand)) }}
    @component('dashboard::components.box')
        @slot('title', trans('brands.actions.edit'))

        @include('dashboard.brands.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('brands.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>