<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\CurrencyExchangeRate;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::factory()
            ->count(4)
            ->state(
                new Sequence(
                    [
                        'name:ar' => 'دينار كويتي',
                        'name:en' => 'Kuwaiti Dinar',
                        'symbol:ar' => 'د.ك',
                        'symbol:en' => 'KWD',
                        'code' => 'KWD',
                        'is_default' => true,
                    ],
                    [
                        'name:ar' => 'جنيه مصري',
                        'name:en' => 'Egyptian Pound',
                        'symbol:ar' => 'ج.م',
                        'symbol:en' => 'EGP',
                        'code' => 'EGP',
                    ],
                    [
                        'name:ar' => 'ريال سعودي',
                        'name:en' => 'Saudi Riyal',
                        'symbol:ar' => 'ر.س',
                        'symbol:en' => 'SAR',
                        'code' => 'SAR',
                    ],
                    [
                        'name:ar' => 'دولار امريكي',
                        'name:en' => 'American dollar',
                        'symbol:ar' => '$',
                        'symbol:en' => '$',
                        'code' => 'USD',
                    ]
                )
            )
            ->create();

        $kuwaiti = Currency::where('code', 'KWD')->first();

        CurrencyExchangeRate::factory([
            'currency_from' => $kuwaiti,
            'currency_to' => Currency::where('code', 'EGP')->first(),
            'rate' => '51.39',
        ])->create();

        CurrencyExchangeRate::factory([
            'currency_from' => $kuwaiti,
            'currency_to' => Currency::where('code', 'SAR')->first(),
            'rate' => '12.27',
        ])->create();

        CurrencyExchangeRate::factory([
            'currency_from' => $kuwaiti,
            'currency_to' => Currency::where('code', 'USD')->first(),
            'rate' => '3.27',
        ])->create();
    }
}
