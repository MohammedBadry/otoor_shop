@include('dashboard.errors')
@bsMultilangualFormTabs
{{ BsForm::text('name') }}
@endBsMultilangualFormTabs

{{ BsForm::price('price')->currency(country()->currency) }}

@if(isset($collection))
    <select2
            name="products[]"
            :multiple="true"
            label="@lang('products.plural')"
            placeholder="@lang('products.select')"
            remote-url="{{ route('products.select') }}"
            :value="{{ $collection->products()->pluck('product_id') }}"
    ></select2>
    {{ BsForm::image('images')->unlimited()->files($collection->getMediaResource()) }}
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

