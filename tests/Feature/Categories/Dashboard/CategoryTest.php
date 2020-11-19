<?php

namespace Tests\Feature\Categories\Dashboard;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Astrotomic\Translatable\Validation\RuleFactory;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The list of unauthorized user types.
     *
     * @return array
     */
    public function unauthorizedUserTypes()
    {
        return [
            [\App\Models\Customer::class],
        ];
    }

    /**
     * @param string $user
     * @dataProvider  unauthorizedUserTypes
     * @test
     */
    public function unauthorized_users_can_not_access_categories($user)
    {
        $model = $user::factory()->create();

        $this->actingAs($model);

        $this->get(route('dashboard.categories.index'))->assertForbidden();
    }

    /** @test */
    public function it_can_list_categories()
    {
        $this->app->setLocale('en');

        $this->actingAsAdmin();

        Category::factory()->create(['name:en' => 'Cars']);

        $response = $this->get(route('dashboard.categories.index'));

        $response->assertSuccessful();

        $response->assertSee('Cars');
    }

    /** @test */
    public function it_can_display_category_details()
    {
        $this->app->setLocale('en');

        $this->actingAsAdmin();

        $category = Category::factory()

            ->has(Category::factory(['name:en' => 'BMW']), 'subcategories')
            ->create(['name:en' => 'Cars']);

        $response = $this->get(route('dashboard.categories.show', $category));

        $response->assertSuccessful();

        $response->assertSee('Cars')->assertSee('BMW');
    }

    /** @test */
    public function it_can_create_a_new_category()
    {
        $this->actingAsAdmin();

        $categoriesCount = Category::count();

        $response = $this->post(
            route('dashboard.categories.store'),
            RuleFactory::make([
                '%name%' => 'Cars',
                'description' => 'foo bar',
            ])
        );

        $response->assertRedirect();

        $this->assertEquals(Category::count(), $categoriesCount + 1);
    }

    /** @test */
    public function it_can_display_category_create_form()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.categories.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('categories.actions.create'));
    }

    /** @test */
    public function it_can_display_category_edit_form()
    {
        $this->actingAsAdmin();

        $category = Category::factory()->create();

        $response = $this->get(route('dashboard.categories.edit', $category));

        $response->assertSuccessful();

        $response->assertSee(trans('categories.actions.edit'));
    }

    /** @test */
    public function it_can_update_category()
    {
        $this->actingAsAdmin();

        $category = Category::factory()->create();

        $response = $this->put(
            route('dashboard.categories.update', $category),
            RuleFactory::make([
                '%name%' => 'Cars',
            ])
        );

        $category->refresh();

        $response->assertRedirect();

        $this->assertEquals($category->name, 'Cars');
    }

    /** @test */
    public function it_can_delete_category()
    {
        $this->actingAsAdmin();

        $category = Category::factory()->create();

        $categoriesCount = Category::count();

        $this->assertEquals(Category::count(), $categoriesCount);

        $response = $this->delete(
            route('dashboard.categories.destroy', $category)
        );

        $response->assertRedirect();

        $this->assertEquals(Category::count(), $categoriesCount - 1);
    }
}
