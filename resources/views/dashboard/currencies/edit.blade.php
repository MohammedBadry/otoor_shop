<x-layout :title="$currency->name" :breadcrumbs="['dashboard.currencies.edit', $currency]">
    {{ BsForm::resource('currencies')->putModel($currency, route('dashboard.currencies.update', $currency)) }}
    @component('dashboard::components.box')
        @slot('title', trans('currencies.actions.edit'))

        @include('dashboard.currencies.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('currencies.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>