@include('dashboard.errors')

@bsMultilangualFormTabs
{{ BsForm::text('name') }}
@endBsMultilangualFormTabs
{{ BsForm::text('code') }}
{{ BsForm::number('value')->max(100) }}
{{ BsForm::price('min_total')->currency(currency()->symbol) }}
{{ BsForm::number('usage_count')->min(1) }}
{{ BsForm::number('usage_per_user')->min(1) }}
