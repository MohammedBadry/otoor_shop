<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'country_id' => Country::factory(),
            'name' => $this->faker->city,
            'shipping_price' => $this->faker->numberBetween(100, 900),
        ];
    }

    /**
     * @param \App\Models\Country $country
     * @return \Database\Factories\CityFactory
     */
    public function country(Country $country)
    {
        return $this->state([
            'country_id' => $country,
        ]);
    }
}
