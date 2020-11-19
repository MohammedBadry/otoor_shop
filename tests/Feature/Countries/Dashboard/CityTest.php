<?php

namespace Tests\Feature\Countries\Dashboard;

use Tests\TestCase;
use App\Models\City;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Astrotomic\Translatable\Validation\RuleFactory;

class CityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_new_city()
    {
        $this->actingAsAdmin();
        $country = Country::factory()->create();
        $this->assertEquals(0, City::count());
        $response = $this->post(
            route('dashboard.countries.cities.store', $country),
            RuleFactory::make([
                '%name%' => 'Cairo',
                'shipping_price' => '500',
            ])
        );
        $response->assertRedirect();
        $this->assertEquals(1, City::count());
    }

    /** @test */
    public function it_can_display_country_edit_form()
    {
        $this->actingAsAdmin();
        $city = City::factory()->create();
        $response = $this->get(route('dashboard.countries.cities.edit', [$city->country, $city]));
        $response->assertSuccessful();
        $response->assertSee(trans('cities.actions.edit'));
    }

    /** @test */
    public function it_can_update_country()
    {
        $this->actingAsAdmin();

        $this->assertEquals(0, City::count());

        $city = City::factory()->create();

        $response = $this->put(
            route('dashboard.countries.cities.update', [$city->country, $city]),
            RuleFactory::make([
                '%name%' => 'Cairo',
                'shipping_price' => '500',
            ])
        );

        $city->refresh();

        $response->assertRedirect();

        $this->assertEquals($city->name, 'Cairo');
        $this->assertEquals($city->shipping_price, '500');
    }

    /** @test */
    public function it_can_delete_city()
    {
        $this->actingAsAdmin();
        $city = City::factory()->create();
        $this->assertEquals(Country::count(), 1);
        $response = $this->delete(route('dashboard.countries.cities.destroy', [
            $city->country,
            $city,
        ]));
        $response->assertRedirect();
        $this->assertEquals(City::count(), 0);
    }
}
