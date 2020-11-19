<?php

namespace Tests\Feature\Countries\Api;

use Tests\TestCase;
use App\Models\City;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SelectTest extends TestCase
{
    use RefreshDatabase;

    public function test_countries_select2_api()
    {
        Country::factory()->count(5)->create();

        $response = $this->getJson(route('countries.select'))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text', 'image'],
                ],
            ]);

        $this->assertEquals($response->json('data.0.id'), 1);

        $this->assertCount(5, $response->json('data'));

        $response = $this->getJson(route('countries.select', ['selected_id' => 4]))
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text', 'image'],
                ],
            ]);

        $this->assertEquals($response->json('data.0.id'), 4);

        $this->assertCount(5, $response->json('data'));
    }

    public function test_cities_select2_api()
    {
        City::factory()->count(5)->create();

        $this->getJson(route('cities.select'))
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'text', 'image'],
                ],
            ]);
    }
}
