@include('dashboard.errors')
@bsMultilangualFormTabs
{{ BsForm::text('name') }}
@endBsMultilangualFormTabs
{{ BsForm::text('code') }}
{{ BsForm::text('key') }}
@isset($country)
    {{ BsForm::image('flag')->collection('flags')->files($country->getMediaResource('flags')) }}
@else
    {{ BsForm::image('flag')->collection('flags') }}
@endisset
{{ BsForm::radio('is_default') }}

