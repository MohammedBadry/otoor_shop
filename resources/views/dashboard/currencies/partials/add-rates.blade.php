@can('create', \App\Models\CurrencyExchangeRate::class)
    {{ BsForm::resource('currency')->post(route('dashboard.currencies.rates.store', $currency)) }}
    @component('dashboard::components.box')
        @slot('title', trans('currencies.actions.add-rates'))

        @foreach($otherCurrencies as $key => $otherCurrency)

            {{ Form::hidden("rates[$key][currency_to]", $otherCurrency->id) }}
            {{ BsForm::price('rate')
                ->name("rates[$key][rate]")
                ->currency($otherCurrency->symbol)
                ->label(trans('currencies.attributes.rate-of', ['currency' => $otherCurrency->name])) }}

        @endforeach

        @slot('footer')
            {{ BsForm::submit()->label(trans('cities.actions.save')) }}
        @endslot
    @endcomponent
    {{ BsForm::close() }}
@endcan