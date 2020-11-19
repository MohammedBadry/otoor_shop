<?php

namespace Tests\Feature\Categories\Api;

use App\Models\Country;
use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_categories()
    {
        $country = Country::factory()->create();

        Category::factory()->country($country)->count(2)->create();

        $this->getJson(route('categories.index', $country))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'description',
                    ],
                ],
            ]);
    }

    /** @test */
    public function it_can_display_category_with_subcategories()
    {
        $country = Country::factory()->create();

        $category = Category::factory()->country($country)->hasSubcategories(5)->create();

        $response = $this->getJson(route('categories.show', [$country, $category]))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'description',
                ],
            ]);

        $this->assertCount(5, $response->json('data.subcategories'));
    }
}
