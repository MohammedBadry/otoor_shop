<?php

namespace Tests\Feature\Products\Api;

use App\Models\Currency;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_products()
    {
        $product = Product::factory()->create(['name' => 'foo']);

        $response = $this->getJson(route('products.index'))
            ->assertSuccessful();

        $this->assertEquals($product->id, $response->json('data.0.id'));
        $this->assertEquals('foo', $response->json('data.0.name'));
    }

    /** @test */
    public function it_can_display_product()
    {
        $product = Product::factory()->create(['name' => 'foo']);

        $response = $this->getJson(route('products.show', $product))
            ->assertSuccessful();

        $this->assertEquals($product->id, $response->json('data.id'));
        $this->assertEquals('foo', $response->json('data.name'));
    }
}
