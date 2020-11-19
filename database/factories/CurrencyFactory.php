<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Currency::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->currencyCode,
            'code' => $this->faker->currencyCode,
            'symbol' => $this->faker->currencyCode,
        ];
    }

    /**
     * @return \Database\Factories\CurrencyFactory
     */
    public function default()
    {
        return $this->state(function () {
            return [
                'is_default' => true,
            ];
        });
    }
}
