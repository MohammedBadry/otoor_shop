<x-layout :title="Str::limit($offer->name, 50)" :breadcrumbs="['dashboard.offers.edit', $offer]">
    {{ BsForm::resource('offers')->putModel($offer, route('dashboard.offers.update', $offer)) }}
    @component('dashboard::components.box')
        @slot('title', trans('offers.actions.edit'))

        @include('dashboard.offers.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('offers.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>