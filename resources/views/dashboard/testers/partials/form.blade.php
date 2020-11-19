@include('dashboard.errors')
@bsMultilangualFormTabs
{{ BsForm::text('name') }}
@endBsMultilangualFormTabs

{{ BsForm::price('price')->currency(country()->currency) }}


@if(isset($tester))
    <select2
            name="products[]"
            :multiple="true"
            label="@lang('products.plural')"
            placeholder="@lang('products.select')"
            remote-url="{{ route('products.select') }}"
            :value="{{ $tester->products()->pluck('product_id') }}"
    ></select2>
    {{ BsForm::image('images')->unlimited()->files($tester->getMediaResource()) }}
@else

    <select2
            name="products[]"
            :multiple="true"
            label="@lang('products.plural')"
            placeholder="@lang('products.select')"
            remote-url="{{ route('products.select') }}"
    ></select2>
    {{ BsForm::image('images')->unlimited() }}
@endif




