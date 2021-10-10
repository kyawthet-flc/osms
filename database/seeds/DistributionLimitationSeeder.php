<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\DistributionLimitation as ObjTable;

class DistributionLimitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ObjTable::truncate();
        
        $items = array(
            array('ctg_ldi_id' => '01','ctg_ldi_desc' => 'Private hospitals','ctg_ldi_obs' => '','ctg_tpr_id' => '02','ctg_ldi_sta' => '2','ctg_ldi_usr' => '803223','ctg_ldi_dt' => '2017-07-24 16:36:41'),
            array('ctg_ldi_id' => '02','ctg_ldi_desc' => 'Public hospitals','ctg_ldi_obs' => '','ctg_tpr_id' => '02','ctg_ldi_sta' => '2','ctg_ldi_usr' => '803223','ctg_ldi_dt' => '2017-07-24 16:36:55'),
            array('ctg_ldi_id' => '03','ctg_ldi_desc' => 'health centers','ctg_ldi_obs' => '','ctg_tpr_id' => '02','ctg_ldi_sta' => '2','ctg_ldi_usr' => '803223','ctg_ldi_dt' => '2017-07-24 16:37:10'),
            array('ctg_ldi_id' => 'NDCP','ctg_ldi_desc' => 'National Disease Control Programme','ctg_ldi_obs' => '','ctg_tpr_id' => '02','ctg_ldi_sta' => '1','ctg_ldi_usr' => '803223','ctg_ldi_dt' => '2017-10-16 01:49:13'),
            array('ctg_ldi_id' => 'HOM','ctg_ldi_desc' => 'Hospital-only Medicine','ctg_ldi_obs' => '','ctg_tpr_id' => '02','ctg_ldi_sta' => '1','ctg_ldi_usr' => '803223','ctg_ldi_dt' => '2017-10-16 01:49:49')
          );

        $productTypes = \App\Model\ProductSetup\ProductType::pluck('id', 'description');

        foreach($items as $item) {
            ObjTable::create([
                'code' => $item['ctg_ldi_id'],
                'name' => $item['ctg_ldi_desc'],
                'description' => '',
                'observance' => $item['ctg_ldi_obs'],
                'product_type_id' => isset($productTypes[$item['ctg_tpr_id']])? $productTypes[$item['ctg_tpr_id']]: NULL,
                'dl_status' =>  $item['ctg_ldi_sta'],
                'addon' => json_encode($item),
            ]);
        }

    }
}
