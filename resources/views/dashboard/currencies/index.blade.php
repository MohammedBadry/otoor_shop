<x-layout :title="trans('currencies.plural')" :breadcrumbs="['dashboard.currencies.index']">
    @include('dashboard.currencies.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title', trans('currencies.actions.list'))
        @slot('tools')
            @include('dashboard.currencies.partials.actions.create')
        @endslot

        <thead>
        <tr>
            <th>@lang('currencies.attributes.name')</th>
            <th class="d-none d-md-table-cell">@lang('currencies.attributes.code')</th>
            <th class="d-none d-md-table-cell">@lang('currencies.attributes.is_default')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($currencies as $currency)
            <tr>
                <td>
                    <a href="{{ route('dashboard.currencies.show', $currency) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ $currency->name }}
                    </a>
                </td>
                <td class="d-none d-md-table-cell">
                    {{ $currency->code }}
                </td>
                <td class="d-none d-md-table-cell">
                    @include('dashboard.currencies.partials.flags.default')
                </td>

                <td style="width: 160px">
                    @include('dashboard.currencies.partials.actions.show')
                    @include('dashboard.currencies.partials.actions.edit')
                    @include('dashboard.currencies.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('currencies.empty')</td>
            </tr>
        @endforelse

        @if($currencies->hasPages())
            @slot('footer')
                {{ $currencies->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
