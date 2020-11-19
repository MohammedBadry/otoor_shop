@include('dashboard.errors')
@bsMultilangualFormTabs
{{ BsForm::text('name') }}
@endBsMultilangualFormTabs

@isset($brand)
    {{ BsForm::image('image')->files($brand->getMediaResource()) }}
@else
    {{ BsForm::image('image') }}
@endisset

