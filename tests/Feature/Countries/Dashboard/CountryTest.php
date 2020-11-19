<?php

namespace Tests\Feature\Countries\Dashboard;

use Tests\TestCase;
use App\Models\City;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Astrotomic\Translatable\Validation\RuleFactory;

class CountryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_countries()
    {
        $this->actingAsAdmin();

        Country::factory()->create(['name' => 'Egypt']);

        $response = $this->get(route('dashboard.countries.index'));

        $response->assertSuccessful();

        $response->assertSee('Egypt');
    }

    /** @test */
    public function it_can_display_country_details()
    {
        $this->actingAsAdmin();

        $country = Country::factory(['name' => 'Iraq'])->create();

        $city = City::factory()->create([
            'country_id' => $country->id,
            'name' => 'Baghdad',
        ]);

        $response = $this->get(route('dashboard.countries.show', $country));

        $response->assertSuccessful();

        $response->assertSee('Iraq');
        $response->assertSee('Baghdad');
    }

    /** @test */
    public function it_can_create_a_new_country()
    {
        $this->actingAsAdmin();

        $this->assertEquals(0, Country::count());

        $response = $this->post(
            route('dashboard.countries.store'),
            RuleFactory::make(
                [
                    '%name%' => 'Egypt',
                    'code' => 'eg',
                    'key' => '+2',
                ]
            )
        );

        $response->assertRedirect();

        $this->assertEquals(1, Country::count());
    }

    /** @test */
    public function it_can_display_country_create_form()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('dashboard.countries.create'));

        $response->assertSuccessful();

        $response->assertSee(trans('countries.actions.create'));
    }

    /** @test */
    public function it_can_display_country_edit_form()
    {
        $this->actingAsAdmin();

        $country = Country::factory()->create();

        $response = $this->get(route('dashboard.countries.edit', $country));

        $response->assertSuccessful();

        $response->assertSee(trans('countries.actions.edit'));
    }

    /** @test */
    public function it_can_update_country()
    {
        $this->actingAsAdmin();

        $country = Country::factory()->create();

        $response = $this->put(
            route('dashboard.countries.update', $country),
            RuleFactory::make(
                [
                    '%name%' => 'Egypt',
                    'code' => 'eg',
                    'key' => '+2',
                ]
            )
        );

        $country->refresh();

        $response->assertRedirect();

        $this->assertEquals($country->name, 'Egypt');
    }

    /** @test */
    public function it_determine_default_country_automatic_if_not_set_and_can_replace_default_country()
    {
        $this->assertEquals(Country::count(), 0);

        $defaultCountry = Country::factory()->create(['is_default' => false]);

        $this->assertTrue($defaultCountry->is_default);

        $otherCountry = Country::factory()->create(['is_default' => true]);

        $this->assertNotTrue($defaultCountry->refresh()->is_default);

        $this->assertTrue($otherCountry->is_default);
    }

    /** @test */
    public function it_can_delete_country()
    {
        $this->actingAsAdmin();

        $defaultCountry = Country::factory()->create(['is_default' => true]);

        $response = $this->delete(route('dashboard.countries.destroy', $defaultCountry));

        $response->assertForbidden();

        $country = Country::factory()->create(['is_default' => false]);

        $this->assertEquals(Country::count(), 2);

        $response = $this->delete(route('dashboard.countries.destroy', $country));

        $response->assertRedirect();

        $this->assertEquals(Country::count(), 1); // Default
    }
}
