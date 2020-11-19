@include('dashboard.errors')

@bsMultilangualFormTabs
{{ BsForm::text('name') }}
{{ BsForm::textarea('description')->attribute('class', 'form-control textarea') }}
@endBsMultilangualFormTabs