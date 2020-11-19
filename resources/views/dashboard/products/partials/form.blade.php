@include('dashboard.errors')
@bsMultilangualFormTabs
{{ BsForm::text('name') }}
{{ BsForm::textarea('description')->attribute('class', 'form-control textarea') }}
{{ BsForm::textarea('meta_description')->rows(3) }}
{{ BsForm::text('meta_keywords')->attribute('class', 'form-control tags') }}
@endBsMultilangualFormTabs

{{ BsForm::price('price')->currency(country()->currency) }}

@isset($sizes)
    <sizes-component :sizes="{{ $product->sizes }}"></sizes-component>
@else
    <sizes-component></sizes-component>
@endisset
<select2
        name="category_id"
        label="@lang('categories.singular')"
        placeholder="@lang('categories.select')"
        remote-url="{{ route('categories.select') }}"
        value="{{ $product->category_id ?? old('category_id') }}"
></select2>
<select2
        name="brand_id"
        label="@lang('brands.singular')"
        placeholder="@lang('brands.select')"
        remote-url="{{ route('brands.select') }}"
        value="{{ $product->brand_id ?? old('brand_id') }}"
></select2>

@if(isset($product) && ! isset($parentId))
    {{ BsForm::image('images')->unlimited()->files($product->getMediaResource()) }}
@else
    {{ BsForm::image('images')->unlimited() }}
@endif