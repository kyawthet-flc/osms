<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\DispensingModality;

class DispensingModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DispensingModality::truncate();

        $dispensing_modalities = array(
            array('ctg_mve_id' => 'NA','ctg_mve_desc' => 'UNASSIGNED','ctg_mve_obs' => '','ctg_tpr_id' => '02','ctg_mve_sta' => '2','ctg_mve_usr' => '803223','ctg_mve_dt' => '2017-12-18 07:34:49'),
            array('ctg_mve_id' => 'HCD','ctg_mve_desc' => 'Highly Controlled Medicine','ctg_mve_obs' => 'This medicine is restricted to be distributed at permitted drug shops where controlled drugs are allowed to be sold under the rules and regulations as stipulated.','ctg_tpr_id' => '02','ctg_mve_sta' => '2','ctg_mve_usr' => '803223','ctg_mve_dt' => '2018-02-13 01:22:42'),
            array('ctg_mve_id' => 'LCD','ctg_mve_desc' => 'Limited Controlled Medicine','ctg_mve_obs' => 'This medicine is restricted to be distributed at permitted drug shops where controlled drugs are allowed to be sold under the rules and regulations as stipulated.','ctg_tpr_id' => '02','ctg_mve_sta' => '2','ctg_mve_usr' => '803223','ctg_mve_dt' => '2018-02-13 01:23:00'),
            array('ctg_mve_id' => 'OTC','ctg_mve_desc' => 'Over The Counter Medicine','ctg_mve_obs' => '','ctg_tpr_id' => '02','ctg_mve_sta' => '2','ctg_mve_usr' => '803223','ctg_mve_dt' => '2018-02-13 01:23:24'),
            array('ctg_mve_id' => 'POM','ctg_mve_desc' => 'Prescription Only Medicine','ctg_mve_obs' => '','ctg_tpr_id' => '02','ctg_mve_sta' => '2','ctg_mve_usr' => '803223','ctg_mve_dt' => '2018-02-13 01:23:43')
        );

        foreach ($dispensing_modalities as $key => $dispensing_modality) {
            DispensingModality::create([
                'name' => $dispensing_modality['ctg_mve_id'],
                'description' => $dispensing_modality['ctg_mve_desc'],
                'observance' => $dispensing_modality['ctg_mve_obs']
            ]);
        }
    }
}