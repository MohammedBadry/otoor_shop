<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingSeeder::class);

        $this->call(CurrencySeeder::class);

        $this->call(CountrySeeder::class);

        $this->call(BrandSeeder::class);

        $this->call(ProductSeeder::class);
    }
}
