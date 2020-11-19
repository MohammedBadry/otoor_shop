<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'qty' => $this->faker->numberBetween(1, 10),
            'product_id' => $product = Product::factory(),
            'price' => function ($attributes) {
                if (isset($attributes['product_id'])) {
                    return Product::find($attributes['product_id'])->price;
                }
            },
            'order_id' => Order::factory()->for($product),
        ];
    }
}
