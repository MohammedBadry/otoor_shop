<?php

namespace Tests\Feature\Products\Dashboard;

use App\Models\Currency;
use App\Support\Money;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Astrotomic\Translatable\Validation\RuleFactory;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The list of unauthorized user types.
     *
     * @return array
     */
    public function unauthorizedUsers()
    {
        return [
            [\App\Models\Customer::class],
        ];
    }

    /**
     * @param string $user
     * @dataProvider  unauthorizedUsers
     * @test
     */
    public function unauthorized_users_can_not_access_products($user)
    {
        $model = $user::factory()->create();

        $this->actingAs($model);

        $this->get(route('dashboard.products.index'))->assertForbidden();
    }

    /** @test */
    public function it_can_list_products()
    {
        $this->app->setLocale('en');

        $this->actingAsAdmin();

        Product::factory()->create(['name:en' => 'foo']);

        $response = $this->get(route('dashboard.products.index'));

        $response->assertSuccessful();

        $response->assertSee('foo');
    }

    /** @test */
    public function it_can_display_product_details()
    {
        $this->partialMock(Money::class, function ($m) {
            $m->shouldReceive('convert')->andReturn(500);
        });

        $this->app->setLocale('en');

        $this->actingAsAdmin();

        $product = Product::factory()
            ->create(['name:en' => 'Cars']);

        $response = $this->get(route('dashboard.products.show', $product));

        $response->assertSuccessful();

        $response->assertSee('Cars');
    }

    /** @test */
    public function it_can_create_a_new_product()
    {
        $this->actingAsAdmin();

        $productsCount = Product::count();

        $response = $this->post(
            route('dashboard.products.store'),
            RuleFactory::make([
                '%name%' => 'Cars',
                '%description%' => 'description',
                '%meta_description%' => 'meta description',
                '%meta_keywords%' => 'meta keywords',
                'price' => 200,
                'category_id' => Category::factory()->create()->id,
            ])
        );

        $response->assertRedirect();

        $this->assertEquals(Product::count(), $productsCount + 1);
    }

    /** @test */
    public function it_can_display_product_create_form()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.products.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('products.actions.create'));
    }

    /** @test */
    public function it_can_display_product_edit_form()
    {
        $this->actingAsAdmin();

        $product = Product::factory()->create();

        $response = $this->get(route('dashboard.products.edit', $product));

        $response->assertSuccessful();

        $response->assertSee(trans('products.actions.edit'));
    }

    /** @test */
    public function it_can_update_product()
    {
        $this->actingAsAdmin();

        $product = Product::factory()->create();

        $response = $this->put(
            route('dashboard.products.update', $product),
            RuleFactory::make([
                '%name%' => 'Cars',
                '%description%' => 'description',
                '%meta_description%' => 'meta description',
                '%meta_keywords%' => 'meta keywords',
                'price' => 200,
                'category_id' => Category::factory()->create()->id,
            ])
        );

        $product->refresh();

        $response->assertRedirect();

        $this->assertEquals($product->name, 'Cars');
    }

    /** @test */
    public function it_can_delete_product()
    {
        $this->actingAsAdmin();

        $product = Product::factory()->create();

        $productsCount = Product::count();

        $response = $this->delete(
            route('dashboard.products.destroy', $product)
        );

        $response->assertRedirect();

        $this->assertEquals(Product::count(), $productsCount - 1);
    }
}
