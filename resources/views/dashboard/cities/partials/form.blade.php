@include('dashboard.errors')
@bsMultilangualFormTabs
{{ BsForm::text('name') }}
@endBsMultilangualFormTabs
{{ BsForm::price('shipping_price')->currency($country->currency) }}

@isset($countryId)
    <input type="hidden" name="country_id" value="{{ $countryId }}">
@else
    <input type="hidden" name="country_id" value="{{ $country->id }}">
@endisset


