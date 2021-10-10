<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\TypeOfProcedure;
use App\Model\ProductSetup\OnetimeProcedure;

class TypeOfProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeOfProcedure::truncate();
        OnetimeProcedure::truncate();

        $type_of_procedures = [
            ['name' => 'BIO', 'description' => 'Biological products such as vaccines and biotechnological products'],
            ['name' => 'FSU', 'description' => 'Food supplements'],
            ['name' => 'GEN', 'description' => 'Generic Medicines Procedure'],

            ['name' => 'NPM', 'description' => 'Product new to Myanmar'],
            ['name' => 'REN-14', 'description' => 'Renewal of drug registration certificates issued until 31 December 2014'],
            ['name' => 'REN-15', 'description' => '	Renewal of drug registration certificates issued after 31 December 2014'],

            ['name' => 'SPE', 'description' => 'Special access products. It concerns donations and products for specific disease control programmes'],
        ];

        $onetime_procedures = [
            ['name' => 'Special Access', 'description' => 'Special access products. It concerns donations and products for specific disease control programmes'],
            ['name' => 'During DRC Renewal', 'description' => 'Renewal of drug registration certificates'],
            ['name' => 'During DIAC Renewal', 'description' => 'Renewal of  drug import approval certificate'],
        ];

        foreach ($type_of_procedures as $key => $type_of_procedure) {
            TypeOfProcedure::create(['name' => $type_of_procedure['name'], 'description' => $type_of_procedure['description'] ]);
        }
        foreach ($onetime_procedures as $key => $onetime_procedure) {
            OnetimeProcedure::create(['name' => $onetime_procedure['name'], 'description' => $onetime_procedure['description'] ]);
        }
    }
}

/* 
BIO 	Biological products such as vaccines and biotechnological products
FSU 	Food supplements
GEN 	Generic Medicines Procedure

NPM 	Product new to Myanmar
REN-14 	Renewal of drug registration certificates issued until 31 December 2014
REN-15 	Renewal of drug registration certificates issued after 31 December 2014

SPE 	Special access products. It concerns donations and products for specific disease control programmes
*/