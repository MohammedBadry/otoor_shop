<x-layout :title="trans('brands.plural')" :breadcrumbs="['dashboard.brands.index']">
    @include('dashboard.brands.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title', trans('brands.actions.list'))
        @slot('tools')
            @include('dashboard.brands.partials.actions.create')
        @endslot

        <thead>
        <tr>
            <th>@lang('brands.attributes.name')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($brands as $brand)
            <tr>
                <td>
                    <a href="{{ route('dashboard.brands.show', $brand) }}"
                       class="text-decoration-none text-ellipsis">

                        <img src="{{ $brand->getFirstMediaUrl() }}"
                             alt="Product 1"
                             class="img-circle img-size-32 mr-2" style="height: 32px;">
                        {{ $brand->name }}
                    </a>
                </td>

                <td style="width: 160px">
                    @include('dashboard.brands.partials.actions.show')
                    @include('dashboard.brands.partials.actions.edit')
                    @include('dashboard.brands.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('brands.empty')</td>
            </tr>
        @endforelse

        @if($brands->hasPages())
            @slot('footer')
                {{ $brands->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
