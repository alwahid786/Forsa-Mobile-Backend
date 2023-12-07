<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PriceUnit;
class PriceUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        $priceUnitsData = [
            ['name' => 'United Arab Emirates Dirham', 'price_unit' => 'AED'],
            ['name' => 'Saudi Riyal', 'price_unit' => 'SAR'],
            ['name' => 'Qatari Riyal', 'price_unit' => 'QAR'],
            ['name' => 'Kuwaiti Dinar', 'price_unit' => 'KWD'],
            ['name' => 'Jordanian Dinar', 'price_unit' => 'JOD'],
            ['name' => 'Moroccan Dirham', 'price_unit' => 'MAD'],
            ['name' => 'Bahraini Dinar', 'price_unit' => 'BHD'],
            ['name' => 'Egyptian Pound', 'price_unit' => 'EGP'],
            ['name' => 'United States Dollar', 'price_unit' => 'USD'],
            ['name' => 'Euro', 'price_unit' => 'EUR'],
            ['name' => 'Canadian Dollar', 'price_unit' => 'CAD'],
        ];

        foreach ($priceUnitsData as $priceUnitData) {
            PriceUnit::create($priceUnitData);
        }
    }
}
