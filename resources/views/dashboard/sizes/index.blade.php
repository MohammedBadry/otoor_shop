<x-layout :title="trans('sizes.plural')" :breadcrumbs="['dashboard.sizes.index']">
    @include('dashboard.sizes.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title', trans('sizes.actions.list'))
        @slot('tools')
            @include('dashboard.sizes.partials.actions.create')
        @endslot

        <thead>
        <tr>
            <th>@lang('sizes.attributes.name')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($sizes as $size)
            <tr>
                <td>
                    <a href="{{ route('dashboard.sizes.show', $size) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ $size->name }}
                    </a>
                </td>

                <td style="width: 160px">
                    @include('dashboard.sizes.partials.actions.show')
                    @include('dashboard.sizes.partials.actions.edit')
                    @include('dashboard.sizes.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('sizes.empty')</td>
            </tr>
        @endforelse

        @if($sizes->hasPages())
            @slot('footer')
                {{ $sizes->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
