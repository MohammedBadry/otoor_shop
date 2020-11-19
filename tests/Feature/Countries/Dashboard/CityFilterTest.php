<?php

namespace Tests\Feature\Countries\Dashboard;

use Tests\TestCase;
use App\Models\City;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CityFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_cities_by_name()
    {
        $this->actingAsAdmin();

        $this->app->setLocale('en');

        $country = Country::factory()->create([
            'name:en' => 'Egypt',
            'name:ar' => 'مصر',
        ]);

        City::factory()->create([
            'country_id' => $country->id,
            'name:en' => 'Ciro',
            'name:ar' => 'القاهرة',
        ]);

        City::factory()->create([
            'country_id' => $country->id,
            'name:en' => 'Alexandria',
            'name:ar' => 'الاسكندرية',
        ]);

        $this->get(route('dashboard.countries.show', [
            $country,
            'name' => 'alex',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('cities.filter'))
            ->assertSee('Alexandria')
            ->assertDontSee('Ciro');
    }
}
