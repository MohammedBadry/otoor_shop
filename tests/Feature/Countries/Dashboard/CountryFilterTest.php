<?php

namespace Tests\Feature\Countries\Dashboard;

use Tests\TestCase;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_countries_by_name()
    {
        $this->actingAsAdmin();

        $this->app->setLocale('en');

        Country::factory()->create([
            'name:en' => 'Iraq',
            'name:ar' => 'العراق',
        ]);

        Country::factory()->create([
            'name:en' => 'Egypt',
            'name:ar' => 'مصر',
        ]);

        $this->get(route('dashboard.countries.index', [
            'name' => 'عراق',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('countries.filter'))
            ->assertSee('Iraq')
            ->assertDontSee('Egypt');
    }

    /** @test */
    public function it_can_filter_countries_by_code()
    {
        $this->actingAsAdmin();

        $this->app->setLocale('en');

        $iraq = Country::factory()->create(['code' => 'iq']);

        $egypt = Country::factory()->create(['code' => 'eg']);

        $this->get(route('dashboard.countries.index', [
            'code' => 'iq',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('countries.filter'))
            ->assertSee($iraq->name)
            ->assertDontSee($egypt->name);
    }

    /** @test */
    public function it_can_filter_countries_by_key()
    {
        $this->actingAsAdmin();

        $this->app->setLocale('en');

        $iraq = Country::factory()->create(['key' => '+964']);

        $egypt = Country::factory()->create(['code' => '+20']);

        $this->get(route('dashboard.countries.index', [
            'key' => '+964',
        ]))
            ->assertSuccessful()
            ->assertSee(trans('countries.filter'))
            ->assertSee($iraq->name)
            ->assertDontSee($egypt->name);
    }
}
