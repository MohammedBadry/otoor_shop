@include('dashboard.errors')
@bsMultilangualFormTabs
{{ BsForm::text('name') }}
{{ BsForm::textarea('description')->attribute('class', 'form-control textarea') }}
{{ BsForm::textarea('meta_description')->rows(3) }}
{{ BsForm::text('meta_keywords')->attribute('class', 'form-control tags') }}
@endBsMultilangualFormTabs
@isset($parentId)
    {{ Form::hidden('parent_id', $parentId) }}
@endisset
<select2
        name="country_id"
        label="@lang('countries.singular')"
        placeholder="@lang('countries.select')"
        remote-url="{{ route('countries.select') }}"
        value="{{ $category->country_id ?? old('country_id') ?? country()->id }}"
></select2>

{{ BsForm::checkbox('display_in_navbar')
        ->checked($category->display_in_navbar ?? old('display_in_navbar'))
        ->value(1)
        ->default(0) }}

@if(isset($category) && ! isset($parentId))
    {{ BsForm::image('image')->files($category->getMediaResource()) }}
@else
    {{ BsForm::image('image') }}
@endif

