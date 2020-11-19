<?php

namespace Tests\Feature\Products\Dashboard;

use App\Models\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_products_by_its_name()
    {
        $this->actingAsAdmin();

        $this->app->setLocale('en');

        Product::factory()->create(['name:en' => 'foo']);

        Product::factory()->create(['name:en' => 'baz']);

        $this->get(route('dashboard.products.index', [
            'name' => 'foo',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('products.filter'))
            ->assertSee('foo')
            ->assertDontSee('baz');
    }
}
