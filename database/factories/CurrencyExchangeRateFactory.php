<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\CurrencyExchangeRate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyExchangeRateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CurrencyExchangeRate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'day' => today(),
            'currency_from' => Currency::factory(),
            'currency_to' => Currency::factory(),
            'rate' => rand(1, 50),
        ];
    }

    /**
     * @param \App\Models\Currency $currency
     * @return \Database\Factories\CurrencyExchangeRateFactory
     */
    public function from(Currency $currency)
    {
        return $this->state(function () use ($currency) {
            return [
                'currency_from' => $currency,
            ];
        });
    }
    /**
     * @param \App\Models\Currency $currency
     * @return \Database\Factories\CurrencyExchangeRateFactory
     */
    public function to(Currency $currency)
    {
        return $this->state(function () use ($currency) {
            return [
                'currency_to' => $currency,
            ];
        });
    }
}
