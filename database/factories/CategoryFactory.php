<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'meta_description' => $this->faker->sentence,
            'meta_keywords' => $this->faker->sentence,
            'display_in_navbar' => $this->faker->boolean,
            'country_id' => function ($attributes) {
                $parent = Category::find($attributes['parent_id'] ?? null);

                return $parent ?: Country::factory();
            },
        ];
    }

    /**
     * Assign the given country to category.
     *
     * @param \App\Models\Country $country
     *
     * @return $this
     */
    public function country(Country $country)
    {
        return $this->state([
            'country_id' => $country,
        ]);
    }
}
