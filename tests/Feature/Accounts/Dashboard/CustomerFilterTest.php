<?php

namespace Tests\Feature\Accounts\Dashboard;

use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerFilterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_filter_customers_by_name()
    {
        $this->actingAsAdmin();

        $country = Country::factory()->default()->create();

        Customer::factory()
            ->has(
                Address::factory()
                    ->for(
                        City::factory()->country($country)
                    )
            )
            ->create(['name' => 'Ahmed']);

        Customer::factory()
            ->has(
                Address::factory()
                    ->for(
                        City::factory(['country_id' => $country])
                    )
            )
            ->create(['name' => 'Mohamed']);

        $this->get(route('dashboard.customers.index', [
            'name' => 'ahmed',
        ]))
            ->assertSuccessful()
            ->assertSee('Ahmed')
            ->assertDontSee('Mohamed');
    }

    /** @test */
    public function it_can_filter_customers_by_email()
    {
        $this->actingAsAdmin();

        $country = Country::factory()->default()->create();

        Customer::factory()
            ->has(
                Address::factory()
                    ->for(
                        City::factory()->country($country)
                    )
            )
            ->create([
                'name' => 'User 1',
                'email' => 'user1@demo.com',
            ]);

        Customer::factory()
            ->has(
                Address::factory()
                    ->for(
                        City::factory()->country($country)
                    )
            )
            ->create([
                'name' => 'User 2',
                'email' => 'user2@demo.com',
            ]);

        $this->get(route('dashboard.customers.index', [
            'email' => 'user1@',
        ]))
            ->assertSuccessful()
            ->assertSee('User 1')
            ->assertDontSee('User 2');
    }

    /** @test */
    public function it_can_filter_customers_by_phone()
    {
        $this->actingAsAdmin();

        $country = Country::factory()->default()->create();

        Customer::factory()
            ->has(
                Address::factory()
                    ->for(
                        City::factory()->country($country)
                    )
            )
            ->create([
                'name' => 'User 1',
                'phone' => '123',
            ]);

        Customer::factory()
            ->has(
                Address::factory()
                    ->for(
                        City::factory()->country($country)
                    )
            )
            ->create([
                'name' => 'User 2',
                'email' => '456',
            ]);

        $this->get(route('dashboard.customers.index', [
            'phone' => '123',
        ]))
            ->assertSuccessful()
            ->assertSee('User 1')
            ->assertDontSee('User 2');
    }
}
