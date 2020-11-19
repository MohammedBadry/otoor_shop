<?php

namespace Tests\Feature\Accounts\Dashboard;

use Tests\TestCase;
use App\Models\City;
use App\Models\Address;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_list_of_customer_addresses()
    {
        $this->actingAsAdmin();

        $customer = Customer::factory()->create();

        Address::factory(['address' => 'Egypt'])->create(['user_id' => $customer->id]);

        $response = $this->get(route('dashboard.customers.show', $customer));

        $response->assertSuccessful();

        $response->assertSee('Egypt');
    }

    /** @test */
    public function it_can_create_customers()
    {
        $this->actingAsAdmin();

        $customer = Customer::factory()->create();

        $city = City::factory()->create();

        $addressesCount = $customer->addresses()->count();

        $response = $this->post(
            route('dashboard.customers.addresses.store', $customer),
            [
                'address' => 'Test',
                'city_id' => $city->id,
            ]
        );

        $response->assertRedirect();

        $this->assertEquals($customer->addresses()->count(), $addressesCount + 1);
        $this->assertEquals($customer->addresses->last()->address, 'Test');
    }

    /** @test */
    public function it_can_display_customer_edit_form()
    {
        $this->actingAsAdmin();

        $customer = Customer::factory()->create();

        $address = Address::factory()->create(['user_id' => $customer->id]);

        $response = $this->get(route('dashboard.customers.addresses.edit', [$customer, $address]));

        $response->assertSuccessful();

        $response->assertSee(trans('addresses.actions.edit'));
    }

    /** @test */
    public function it_can_update_customers()
    {
        $this->actingAsAdmin();

        $customer = Customer::factory()->create();

        $address = Address::factory()->create(['user_id' => $customer->id]);

        $city = City::factory()->create();

        $response = $this->put(
            route('dashboard.customers.addresses.update', [$customer, $address]),
            [
                'address' => 'Test',
                'city_id' => $city->id,
            ]
        );

        $response->assertRedirect();

        $address->refresh();

        $this->assertEquals($address->address, 'Test');
        $this->assertEquals($address->city_id, $city->id);
    }

    /** @test */
    public function it_can_delete_customer()
    {
        $this->actingAsAdmin();

        $customer = Customer::factory()->create();

        $address = Address::factory()->create(['user_id' => $customer->id]);

        $addressesCount = $customer->addresses()->count();

        $response = $this->delete(
            route('dashboard.customers.addresses.destroy', [$customer, $address])
        );
        $response->assertRedirect();

        $this->assertEquals($customer->addresses()->count(), $addressesCount - 1);
    }
}
