<?php

namespace App\Support;

use App\Models\Currency;
use App\Models\CurrencyExchangeRate;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Money implements \JsonSerializable
{
    /**
     * @var \App\Models\Currency
     */
    protected $from;

    /**
     * @var \App\Models\Currency
     */
    protected $to;

    /**
     * @var float|int
     */
    protected $price;

    public static function make($price)
    {
        return app(static::class)->price($price);
    }

    /**
     * @param $currency
     * @throws \Exception
     * @return $this
     */
    public function from($currency)
    {
        $this->from = $this->qualifyCurrency($currency);

        return $this;
    }

    /**
     * @param $currency
     * @throws \Exception
     * @return $this
     */
    public function to($currency)
    {
        $this->to = $this->qualifyCurrency($currency);

        return $this;
    }

    /**
     * @param $price
     * @return $this
     */
    public function price($price)
    {
        $this->price = $price;

        return $this;
    }

    public function convert()
    {
        $day = Carbon::parse(request('day', today()));

        $defaultCurrency = Currency::default()->first();

        if (! $this->from) {
            $this->from($defaultCurrency);
        }

        if (! $this->to) {
            $to = $defaultCurrency;

            if ($code = session('currency', request()->header('accept-currency', request('currency')))) {
                $to = Currency::whereCode($code)->first() ?: $defaultCurrency;
            }

            $this->to($to);
        }

        $rate = 1;

        $rateExchange = CurrencyExchangeRate::query()
            ->selectRaw('MAX(rate) as max_rate')
            ->where('currency_from', $this->from->id)
            ->where('currency_to', $this->to->id)
            ->whereDate('day', '<=', $day)
            ->first();

        if ($rateExchange->max_rate) {
            $rate = $rateExchange->max_rate;
        } else {
            $rateExchange = CurrencyExchangeRate::query()
                ->selectRaw('MAX(rate) as max_rate')
                ->where('currency_from', $this->to->id)
                ->where('currency_to', $this->from->id)
                ->whereDate('day', '<=', $day)
                ->first();
            if ($rateExchange->max_rate) {
                return round($this->price / $rateExchange->max_rate, 3);
            }
        }

        return round($this->price * $rate, 3);
    }

    /**
     * Qualify the currency instance.
     *
     * @param $currency
     * @return \App\Models\Currency|void
     */
    protected function qualifyCurrency($currency)
    {
        if ($currency instanceof Currency) {
            return $currency;
        }

        $currency = Currency::where('id', $currency)
            ->orWhere('code', $currency)
            ->orWhereTranslation('symbol', $currency)
            ->orWhereTranslationLike('name', "%$currency%")
            ->first();

        if ($currency) {
            return $currency;
        }
    }

    public function toArray()
    {
        return [
            'price' => $this->convert(),
            'formatted' => $this->formatted(),
        ];
    }

    public function formatted()
    {
        $price = $this->convert();
        if (is_int($this->convert())) {
            $price = number_format($this->convert());
        } else {
            if (Str::contains($price, '.')) {
                $array = explode('.', $this->convert());

                $price = number_format($array[0]).'.'.$array[1];
            }
        }

        return $price.' '.optional($this->to)->symbol;
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function __toString()
    {
        return $this->toJson();
    }
}
