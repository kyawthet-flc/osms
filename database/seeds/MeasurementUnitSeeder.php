<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\MeasurementUnit;

class MeasurementUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MeasurementUnit::truncate();

        $measurement_units = array(
            array('ctg_ume_id' => 'g','ctg_ume_desc' => 'gram','ctg_ume_obs' => '','ctg_tpr_id' => '02','ctg_ume_sta' => '2','ctg_ume_usr' => '803223','ctg_ume_dt' => '2017-09-15 13:37:37'),
            array('ctg_ume_id' => 'kg','ctg_ume_desc' => 'kilogram','ctg_ume_obs' => '','ctg_tpr_id' => '02','ctg_ume_sta' => '2','ctg_ume_usr' => '803223','ctg_ume_dt' => '2017-09-15 13:37:44'),
            array('ctg_ume_id' => 'l','ctg_ume_desc' => 'litre','ctg_ume_obs' => '','ctg_tpr_id' => '02','ctg_ume_sta' => '2','ctg_ume_usr' => '803223','ctg_ume_dt' => '2017-09-15 13:37:57'),
            array('ctg_ume_id' => 'mcg','ctg_ume_desc' => 'microgram','ctg_ume_obs' => '','ctg_tpr_id' => '02','ctg_ume_sta' => '2','ctg_ume_usr' => '803223','ctg_ume_dt' => '2017-09-15 13:38:06'),
            array('ctg_ume_id' => 'mg','ctg_ume_desc' => 'milligram','ctg_ume_obs' => '','ctg_tpr_id' => '02','ctg_ume_sta' => '2','ctg_ume_usr' => '803223','ctg_ume_dt' => '2017-09-15 13:38:20'),
            array('ctg_ume_id' => 'ml','ctg_ume_desc' => 'millilitre','ctg_ume_obs' => '','ctg_tpr_id' => '02','ctg_ume_sta' => '2','ctg_ume_usr' => '803223','ctg_ume_dt' => '2017-09-15 13:38:39'),
            array('ctg_ume_id' => 'IU','ctg_ume_desc' => 'International Unit','ctg_ume_obs' => '','ctg_tpr_id' => '02','ctg_ume_sta' => '2','ctg_ume_usr' => '803223','ctg_ume_dt' => '2017-09-15 13:39:19'),
            array('ctg_ume_id' => 'NA','ctg_ume_desc' => 'Data not available','ctg_ume_obs' => '','ctg_tpr_id' => '02','ctg_ume_sta' => '1','ctg_ume_usr' => '803223','ctg_ume_dt' => '2017-10-27 23:18:35')
        );

        foreach ($measurement_units as $key => $measurement_unit) {
            MeasurementUnit::create(['name' => $measurement_unit['ctg_ume_desc'], 'description' => $measurement_unit['ctg_ume_obs'] ]);
        }
    }
}