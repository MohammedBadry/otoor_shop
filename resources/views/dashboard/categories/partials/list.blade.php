@include('dashboard.categories.partials.filter')

@component('dashboard::components.table-box')
    @slot('title', $title ?? trans('categories.actions.list'))
    @slot('tools')
        @if((isset($createButton) && $createButton) || ! isset($createButton))
            @include('dashboard.categories.partials.actions.create')
        @endif
    @endslot

    <thead>
    <tr>
        <th>@lang('categories.attributes.name')</th>
        <th class="d-none d-md-table-cell">@lang('categories.attributes.country_id')</th>
        <th style="width: 160px">...</th>
    </tr>
    </thead>
    <tbody>
    @forelse($categories as $category)
        <tr>
            <td>
                <a href="{{ route('dashboard.categories.show', $category) }}"
                   class="text-decoration-none text-ellipsis">
                    {{ $category->name }}
                </a>
            </td>
            <td class="d-none d-md-table-cell">
                <a href="{{ route('dashboard.countries.show', $category->country) }}"
                   class="text-decoration-none text-ellipsis">
                    {{ $category->country->name }}
                </a>
            </td>

            <td style="width: 160px">
                @include('dashboard.categories.partials.actions.show')
                @include('dashboard.categories.partials.actions.edit')
                @include('dashboard.categories.partials.actions.delete')
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="100" class="text-center">@lang('categories.empty')</td>
        </tr>
    @endforelse

    @if($categories->hasPages())
        @slot('footer')
            {{ $categories->links() }}
        @endslot
    @endif
@endcomponent