<?php

namespace Tests\Feature\Categories\Dashboard;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_categories_by_its_name()
    {
        $this->actingAsAdmin();

        $this->app->setLocale('en');

        Category::factory()->create(['name:en' => 'cats']);

        Category::factory()->create(['name:en' => 'dogs']);

        $this->get(route('dashboard.categories.index', [
            'name' => 'cats',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('categories.filter'))
            ->assertSee('cats')
            ->assertDontSee('dogs');
    }
}
