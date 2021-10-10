<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\OnetimePurpose;

class OnetimePurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OnetimePurpose::truncate();
        $onetimePurposes = [
            ['name' => 'Covid-19 Related Medicine', 'description' => 'Covid-19 Related Medicine'],
            ['name' => 'Tender', 'description' => 'tender'],
        ]; 
        foreach ($onetimePurposes as $key => $onetimePurpose) {
            OnetimePurpose::create(['name' => $onetimePurpose['name'], 'description' => $onetimePurpose['description'] ]);
        }
    }
}
