<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\AdministrationUnit;

class AdministrationUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdministrationUnit::truncate();

        $administration_units = array(
            ['name' => 'a_unit_01', 'desc' => 'Same as dosage form (e.g. tablet, capsule)'],
            ['name' => 'a_unit_02', 'desc' => 'Same as primary container (e.g. ampoule, vial, sachet)'],
            ['name' => 'a_unit_03', 'desc' => 'Liquid or reconstituted preparation (e.g. oral solution, dry syrup, large volume injectable solution)'],
            ['name' => 'a_unit_04', 'desc' => 'Semisolid (e.g. cream)'],
            ['name' => 'a_unit_other', 'desc' => ' Other, specify']
           
        );

        foreach($administration_units as $administration_unit) {
            AdministrationUnit::create($administration_unit);
        }

    }
}

/* 
Administration unit is 	
	1. Same as dosage form (e.g. tablet, capsule)
	2. Same as primary container (e.g. ampoule, vial, sachet)
	3. Liquid or reconstituted preparation (e.g. oral solution, dry syrup, large volume injectable solution)
	4. Semisolid (e.g. cream)
	5. Other, specify
*/