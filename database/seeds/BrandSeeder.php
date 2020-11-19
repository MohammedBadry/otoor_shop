<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Brand $brand */
        $brand = Brand::factory()->create(['name' => 'Mancera Paris']);
        $brand->addMedia(resource_path('otoraty-design/img/brand/1.png'))
            ->preservingOriginal()
            ->toMediaCollection();

        $brand = Brand::factory()->create(['name' => 'Hugo Boss']);
        $brand->addMedia(resource_path('otoraty-design/img/brand/2.png'))
            ->preservingOriginal()
            ->toMediaCollection();


        $brand = Brand::factory()->create(['name' => 'Lancome Paris']);
        $brand->addMedia(resource_path('otoraty-design/img/brand/4.png'))
            ->preservingOriginal()
            ->toMediaCollection();
    }
}
