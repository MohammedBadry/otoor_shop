@include('dashboard.errors')
@bsMultilangualFormTabs
{{ BsForm::text('name') }}
{{ BsForm::text('symbol') }}
@endBsMultilangualFormTabs
{{ BsForm::text('code') }}
{{ BsForm::radio('is_default') }}

