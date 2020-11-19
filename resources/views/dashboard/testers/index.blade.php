<x-layout :title="trans('testers.plural')" :breadcrumbs="['dashboard.testers.index']">
    @include('dashboard.testers.partials.filter')

    @component('dashboard::components.table-box')
        @slot('title', trans('testers.actions.list'))
        @slot('tools')
            @include('dashboard.testers.partials.actions.create')
        @endslot

        <thead>
        <tr>
            <th>@lang('testers.attributes.name')</th>
            <th style="width: 160px">...</th>
        </tr>
        </thead>
        <tbody>
        @forelse($testers as $tester)
            <tr>
                <td>
                    <a href="{{ route('dashboard.testers.show', $tester) }}"
                       class="text-decoration-none text-ellipsis">

                        <img src="{{ $tester->getFirstMediaUrl() }}"
                             alt="Product 1"
                             class="img-circle img-size-32 mr-2" style="height: 32px;">
                        {{ $tester->name }}
                    </a>
                </td>

                <td style="width: 160px">
                    @include('dashboard.testers.partials.actions.show')
                    @include('dashboard.testers.partials.actions.edit')
                    @include('dashboard.testers.partials.actions.delete')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="100" class="text-center">@lang('testers.empty')</td>
            </tr>
        @endforelse

        @if($testers->hasPages())
            @slot('footer')
                {{ $testers->links() }}
            @endslot
        @endif
    @endcomponent
</x-layout>
