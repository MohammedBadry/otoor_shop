@include('dashboard.errors')
@bsMultilangualFormTabs
{{ BsForm::text('name') }}
@endBsMultilangualFormTabs
{{ Form::hidden('target_type', request('target_type')) }}
{{ Form::hidden('target_id', request('target_id')) }}
{{ BsForm::number('percent')->max(100) }}
{{ BsForm::date('from', $offer->from ?? null) }}
{{ BsForm::date('to', $offer->to ?? null) }}
