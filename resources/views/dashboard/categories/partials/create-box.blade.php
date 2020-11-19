{{ BsForm::resource('categories')->post(route('dashboard.categories.store')) }}
@component('dashboard::components.box')
    @slot('title', $title ?? trans('categories.actions.create'))

    @include('dashboard.categories.partials.form')

    @slot('footer')
        {{ BsForm::submit()->label(trans('categories.actions.save')) }}
    @endslot
@endcomponent
{{ BsForm::close() }}
