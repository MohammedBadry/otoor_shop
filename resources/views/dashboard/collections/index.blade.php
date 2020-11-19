<x-layout :title="trans('collections.plural')" :breadcrumbs="['dashboard.collections.index']">
    @include('dashboard.collections.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title', trans('collections.actions.list'))
        @slot('tools')
            @include('dashboard.collections.partials.actions.create')
        @endslot

        <thead>
        <tr>
            <th>@lang('collections.attributes.name')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($collections as $collection)
            <tr>
                <td>
                    <a href="{{ route('dashboard.collections.show', $collection) }}"
                       class="text-decoration-none text-ellipsis">

                        <img src="{{ $collection->getFirstMediaUrl() }}"
                             alt="Product 1"
                             class="img-circle img-size-32 mr-2" style="height: 32px;">
                        {{ $collection->name }}
                    </a>
                </td>

                <td style="width: 160px">
                    @include('dashboard.collections.partials.actions.show')
                    @include('dashboard.collections.partials.actions.edit')
                    @include('dashboard.collections.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('collections.empty')</td>
            </tr>
        @endforelse

        @if($collections->hasPages())
            @slot('footer')
                {{ $collections->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
