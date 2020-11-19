<x-layout :title="Str::limit($product->name, 50)" :breadcrumbs="['dashboard.products.edit', $product]">
    {{ BsForm::resource('products')->putModel($product, route('dashboard.products.update', $product)) }}
    @component('dashboard::components.box')
        @slot('title', trans('products.actions.edit'))

        @include('dashboard.products.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('products.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>