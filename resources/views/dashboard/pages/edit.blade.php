<x-layout :title="$page->name" :breadcrumbs="['dashboard.pages.edit', $page]">
    {{ BsForm::resource('pages')->putModel($page, route('dashboard.pages.update', $page)) }}
    @component('dashboard::components.box')
        @slot('title', trans('pages.actions.edit'))

        @include('dashboard.pages.partials.form')

        @slot('footer')
            {{ BsForm::submit()->label(trans('pages.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
</x-layout>