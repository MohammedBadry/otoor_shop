@if((isset($filter) && $filter) || ! isset($filter))
    @include('dashboard.products.partials.filter')
@endif
@component('dashboard::components.table-box')
    @slot('title', $title ?? trans('products.actions.list'))
    @slot('tools')
        @if((isset($createButton) && $createButton) || ! isset($createButton))
            @include('dashboard.products.partials.actions.create')
        @endif
    @endslot

    <thead>
    <tr>
        <th>@lang('products.attributes.name')</th>
        <th class="d-none d-md-table-cell">@lang('products.attributes.category_id')</th>
        @if((isset($controls) && $controls) || ! isset($controls))
            <th style="width: 160px">...</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @forelse($products as $product)
        <tr>
            <td>
                <a href="{{ route('dashboard.products.show', $product) }}"
                   class="text-decoration-none text-ellipsis">
                    <img src="{{ $product->getFirstMediaUrl('default', 'thumb') }}"
                         alt="{{ $product->name }}"
                         class="img-size-32 mr-2">
                    {{ $product->name }}
                </a>
            </td>
            <td class="d-none d-md-table-cell">
                <a href="{{ route('dashboard.categories.show', $product->category) }}"
                   class="text-decoration-none text-ellipsis">
                    {{ $product->category->name }}
                </a>
            </td>

            @if((isset($controls) && $controls) || ! isset($controls))
                <td style="width: 160px">
                    @include('dashboard.products.partials.actions.show')
                    @include('dashboard.products.partials.actions.edit')
                    @include('dashboard.products.partials.actions.delete')
                </td>
            @endif
        </tr>
    @empty
        <tr>
            <td colspan="100" class="text-center">@lang('products.empty')</td>
        </tr>
    @endforelse

    @if($products->hasPages())
        @slot('footer')
            {{ $products->links() }}
        @endslot
    @endif
@endcomponent