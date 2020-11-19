<x-layout :title="trans('coupons.plural')" :breadcrumbs="['dashboard.coupons.index']">
    @include('dashboard.coupons.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title', trans('coupons.actions.list'))
        @slot('tools')
            @include('dashboard.coupons.partials.actions.create')
        @endslot

        <thead>
        <tr>
            <th>@lang('coupons.attributes.name')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($coupons as $coupon)
            <tr>
                <td>
                    <a href="{{ route('dashboard.coupons.show', $coupon) }}"
                       class="text-decoration-none text-ellipsis">
                        {{ $coupon->name }}
                    </a>
                </td>

                <td style="width: 160px">
                    @include('dashboard.coupons.partials.actions.show')
                    @include('dashboard.coupons.partials.actions.edit')
                    @include('dashboard.coupons.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('coupons.empty')</td>
            </tr>
        @endforelse

        @if($coupons->hasPages())
            @slot('footer')
                {{ $coupons->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
