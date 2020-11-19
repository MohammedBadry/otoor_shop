<x-layout :title="$currency->name" :breadcrumbs="['dashboard.currencies.show', $currency]">
    <div class="row">
        <div class="col-md-6">
            @component('dashboard::components.box')
                @slot('class', 'p-0')
                @slot('bodyClass', 'p-0')

                <table class="table table-striped table-middle">
                    <tbody>
                    <tr>
                        <th width="200">@lang('currencies.attributes.name')</th>
                        <td>{{ $currency->name }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('currencies.attributes.code')</th>
                        <td>{{ $currency->code }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('currencies.attributes.symbol')</th>
                        <td>{{ $currency->symbol }}</td>
                    </tr>
                    <tr>
                        <th width="200">@lang('currencies.attributes.is_default')</th>
                        <td>@include('dashboard.currencies.partials.flags.default')</td>
                    </tr>
                    </tbody>
                </table>

                @slot('footer')
                    @include('dashboard.currencies.partials.actions.edit')
                    @include('dashboard.currencies.partials.actions.delete')
                @endslot
            @endcomponent
            @if($currency->is_default)
                @include('dashboard.currencies.partials.add-rates')
            @endif

        </div>
        @if($currency->is_default)
            <div class="col-md-6">
                @include('dashboard.currencies.partials.rates')
            </div>
        @endif
    </div>
</x-layout>
