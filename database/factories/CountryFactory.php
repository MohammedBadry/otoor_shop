<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->country,
            'code' => $this->faker->countryCode,
            'key' => $this->faker->randomDigit,
            'currency' => $this->faker->currencyCode,
        ];
    }

    /**
     * @return \Database\Factories\CountryFactory
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
