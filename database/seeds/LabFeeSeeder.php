<?php

use Illuminate\Database\Seeder;

class LabFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lab_fees = array(
            array(
                'id' => 1,
                'gpid' => 0,
                'pid' => 0,
                'name' => 'oral form',
                'desc' => '',
                'amount' => 0
            ),
            array(
                'id' => 2,
                'gpid' => 0,
                'pid' => 0,
                'name' => 'injection/infusion',
                'desc' => '',
                'amount' => 0
            ),
            array(
                'id' => 3,
                'gpid' => 0,
                'pid' => 0,
                'name' => 'other',
                'desc' => '',
                'amount' => 0
            ),

            array(
                'id' => 4,
                'gpid' => 0,
                'pid' => 1,
                'name' => 'single',
                'desc' => '',
                'amount' => 0
            ),
            array(
                'id' => 5,
                'gpid' => 0,
                'pid' => 1,
                'name' => 'combination',
                'desc' => '',
                'amount' => 0
            ),

            array(
                'id' => 6,
                'gpid' => 1,
                'pid' => 4,
                'name' => 'antibiotic',
                'desc' => '',
                'amount' => 300000
            ),
            array(
                'id' => 7,
                'gpid' => 1,
                'pid' => 4,
                'name' => 'other',
                'desc' => '',
                'amount' => 250000
            ),

            array(
                'id' => 8,
                'gpid' => 1,
                'pid' => 5,
                'name' => 'antibiotic',
                'desc' => '',
                'amount' => 400000
            ),
            array(
                'id' => 9,
                'gpid' => 1,
                'pid' => 5,
                'name' => 'other',
                'desc' => '',
                'amount' => 400000
            ),

            array(
                'id' => 10,
                'gpid' => 0,
                'pid' => 2,
                'name' => 'antibiotic',
                'desc' => '',
                'amount' => 0
            ),
            array(
                'id' => 11,
                'gpid' => 0,
                'pid' => 2,
                'name' => 'other',
                'desc' => '',
                'amount' => 0
            ),
            array(
                'id' => 12,
                'gpid' => 2,
                'pid' => 10,
                'name' => 'single',
                'desc' => '',
                'amount' => 500000
            ),
            array(
                'id' => 13,
                'gpid' => 2,
                'pid' => 10,
                'name' => 'combination',
                'desc' => '',
                'amount' => 600000
            ),
            array(
                'id' => 14,
                'gpid' => 2,
                'pid' => 11,
                'name' => 'combination',
                'desc' => '',
                'amount' => 600000
            ),
            array(
                'id' => 15,
                'gpid' => 2,
                'pid' => 11,
                'name' => 'combination',
                'desc' => '',
                'amount' => 600000
            ),
            array(
                'id' => 16,
                'gpid' => 0,
                'pid' => 3,
                'name' => 'single',
                'desc' => '',
                'amount' => 250000
            ),
            array(
                'id' => 17,
                'gpid' => 0,
                'pid' => 3,
                'name' => 'combination',
                'desc' => '',
                'amount' => 250000
            )
        );

        $lab_fees = array(
            array('id' => '1','dosage_form_type' => 'oral','gpid' => '0','pid' => '0','name' => 'oral form','desc' => '','amount' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','dosage_form_type' => 'injection','gpid' => '0','pid' => '0','name' => 'injection/infusion form','desc' => '','amount' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','dosage_form_type' => 'other','gpid' => '0','pid' => '0','name' => 'other dosage form','desc' => '','amount' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','dosage_form_type' => NULL,'gpid' => '0','pid' => '1','name' => 'single','desc' => '','amount' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','dosage_form_type' => NULL,'gpid' => '0','pid' => '1','name' => 'combination','desc' => '','amount' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','dosage_form_type' => NULL,'gpid' => '1','pid' => '4','name' => 'antibiotic','desc' => '','amount' => '300000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','dosage_form_type' => NULL,'gpid' => '1','pid' => '4','name' => 'other','desc' => '','amount' => '250000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','dosage_form_type' => NULL,'gpid' => '1','pid' => '5','name' => 'antibiotic','desc' => '','amount' => '400000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','dosage_form_type' => NULL,'gpid' => '1','pid' => '5','name' => 'other','desc' => '','amount' => '400000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','dosage_form_type' => NULL,'gpid' => '0','pid' => '2','name' => 'antibiotic','desc' => '','amount' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','dosage_form_type' => NULL,'gpid' => '0','pid' => '2','name' => 'other','desc' => '','amount' => '0','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','dosage_form_type' => NULL,'gpid' => '2','pid' => '10','name' => 'single','desc' => '','amount' => '500000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','dosage_form_type' => NULL,'gpid' => '2','pid' => '10','name' => 'combination','desc' => '','amount' => '600000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','dosage_form_type' => NULL,'gpid' => '2','pid' => '11','name' => 'single','desc' => '','amount' => '600000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','dosage_form_type' => NULL,'gpid' => '2','pid' => '11','name' => 'combination','desc' => '','amount' => '600000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '16','dosage_form_type' => NULL,'gpid' => '0','pid' => '3','name' => 'single','desc' => '','amount' => '250000','created_at' => NULL,'updated_at' => NULL),
            array('id' => '17','dosage_form_type' => NULL,'gpid' => '0','pid' => '3','name' => 'combination','desc' => '','amount' => '250000','created_at' => NULL,'updated_at' => NULL)
        );

        // dd($lab_fees);
        \DB::table('lab_fees')->truncate();
        
        foreach ($lab_fees as $key => $lab_fee) {
            \DB::table('lab_fees')->insert($lab_fee);
        }
    }
}
