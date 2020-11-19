{{ BsForm::resource('currencies')->get(url()->current()) }}
@component('dashboard::components.box')
    @slot('title', trans('currencies.filter-rate'))

    {{ BsForm::date('day')->value(request('day', today())) }}

    @slot('footer')
        <button type="submit" class="btn btn-primary btn-sm">
            <i class="fas fa fa-fw fa-filter"></i>
            @lang('currencies.actions.filter')
        </button>
    @endslot
@endcomponent
{{ BsForm::close() }}


@component('dashboard::components.table-box')
    @slot('title', trans('currencies.actions.rates'))
    <thead>
    <tr>
        <th>@lang('currencies.attributes.name')</th>
        <th class="d-none d-md-table-cell">@lang('currencies.attributes.code')</th>
    </tr>
    </thead>
    <tbody>
    @forelse($otherCurrencies as $otherCurrency)
        <tr>
            <td>
                <a href="{{ route('dashboard.currencies.show', $otherCurrency) }}"
                   class="text-decoration-none text-ellipsis">
                    {{ $otherCurrency->name }}
                </a>
            </td>
            <td class="d-none d-md-table-cell">
                @if(\App\Support\Money::make(1)->to($otherCurrency)->convert() > 1)
                {{ \App\Support\Money::make(1)->to($otherCurrency)->formatted() }}
                @else
                    ---
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="100" class="text-center">@lang('currencies.empty')</td>
        </tr>
    @endforelse
@endcomponent
