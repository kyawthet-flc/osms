<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::truncate();

        $units = [
            'Milligram',
            'Microgram',
            'International Unit',
            'Other'
        ];

        foreach ($units as $key => $unit) {
           Unit::create(['name' => $unit]);
        }
    }
}