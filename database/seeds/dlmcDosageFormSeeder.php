<?php

use Illuminate\Database\Seeder;
use App\Model\GeneralSetup\DlmcDosageForm;

class dlmcDosageFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dlmcDosageForms = array([
            'id' => 1,
            'name' => 'Oral',
            'type' => 'GMP',
        ],[
            'id' => 2,
            'parent_id' => 1,
            'name' => 'Uniformity of weight',
            'type' => 'GMP',
        ],[
            'id' => 3,
            'name' => 'Injection/Infusion',
            'type' => 'SME',
        ],[
            'id' => 4,
            'parent_id' => 3,
            'name' => 'Extractable Volume',
            'type' => 'SME',
        ],[
            'id' => 5,
            'parent_id' => 3,
            'name' => 'pH',
            'type' => 'SME',
        ]);

        DlmcDosageForm::truncate();
        foreach($dlmcDosageForms as $dlmcDosageForm) {
            DlmcDosageForm::create($dlmcDosageForm);
        }
    }
}
