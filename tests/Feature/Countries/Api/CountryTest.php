<?php

namespace Tests\Feature\Countries\Api;

use Tests\TestCase;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_countries()
    {
        $this->actingAsAdmin();

        Country::factory()->count(2)->create();

        $this->getJson(route('countries.index'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'code',
                        'key',
                        'is_default',
                        'currency',
                        'flag',
                    ],
                ],
            ]);
    }

    /** @test */
    public function it_can_display_country_with_cities()
    {
        $this->actingAsAdmin();

        $country = Country::factory()->hasCities(5)->create();

        $response = $this->getJson(route('countries.show', $country))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'code',
                    'key',
                    'currency',
                    'flag',
                    'cities' => [
                        '*' => ['id', 'name'],
                    ],
                ],
            ]);

        $this->assertCount(5, $response->json('data.cities'));
    }

    /** @test */
    public function it_can_display_default_country_with_cities()
    {
        $this->actingAsAdmin();

        Country::factory()->default()->hasCities(5)->create();

        $response = $this->getJson(route('countries.default'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'code',
                    'key',
                    'currency',
                    'flag',
                    'cities' => [
                        '*' => ['id', 'name'],
                    ],
                ],
            ]);

        $this->assertCount(5, $response->json('data.cities'));
    }
}
