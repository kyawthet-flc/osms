<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\AnalyticalMethod as ObjTable;

class AnalyticalMethodSeeder extends Seeder
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
            array('ctg_mea_id' => 'U41ALBTAB','ctg_mea_desc' => 'USP41 Albendazole tablets','ctg_mea_obs' => '','ctg_far_id' => 'FULLMONOGRAPH','ctg_tpr_id' => '10','ctg_mea_sta' => '1','ctg_mea_usr' => '803223','ctg_mea_dt' => '2018-05-22 22:53:12'),
            array('ctg_mea_id' => 'U41PZQTAB','ctg_mea_desc' => 'USP41 Praziquantel tablets','ctg_mea_obs' => '','ctg_far_id' => 'FULLMONOGRAPH','ctg_tpr_id' => '10','ctg_mea_sta' => '1','ctg_mea_usr' => '803223','ctg_mea_dt' => '2018-05-22 22:53:46'),
            array('ctg_mea_id' => 'U41DISSO','ctg_mea_desc' => 'USP41 Dissolution','ctg_mea_obs' => '','ctg_far_id' => 'GENMON','ctg_tpr_id' => '10','ctg_mea_sta' => '1','ctg_mea_usr' => '803223','ctg_mea_dt' => '2018-05-22 22:55:37'),
            array('ctg_mea_id' => 'U41UNIFDU','ctg_mea_desc' => 'USP41 Uniformity of dosage units','ctg_mea_obs' => '','ctg_far_id' => 'GENMON','ctg_tpr_id' => '10','ctg_mea_sta' => '1','ctg_mea_usr' => '803223','ctg_mea_dt' => '2018-05-22 22:59:25'),
            array('ctg_mea_id' => 'U41PCTTB','ctg_mea_desc' => 'USP41 Paracetamol Tablet','ctg_mea_obs' => '','ctg_far_id' => 'FULLMONOGRAPH','ctg_tpr_id' => '10','ctg_mea_sta' => '1','ctg_mea_usr' => '8032','ctg_mea_dt' => '2018-05-30 03:44:11'),
            array('ctg_mea_id' => 'U41AMLT','ctg_mea_desc' => 'USP41 Amlodipine tablets monograph','ctg_mea_obs' => '','ctg_far_id' => 'FULLMONOGRAPH','ctg_tpr_id' => '10','ctg_mea_sta' => '1','ctg_mea_usr' => '803223','ctg_mea_dt' => '2018-09-19 04:38:05')
        );

        $productTypes = \App\Model\ProductSetup\ProductType::pluck('id', 'description');

        foreach($items as $item) {
            ObjTable::create([
                'name' => $item['ctg_mea_id'],
                'description' => $item['ctg_mea_desc'],
                'observance' => $item['ctg_mea_obs'],
                'ref_analysis_id' => $item['ctg_far_id'],
                'product_type_id' => isset($productTypes[$item['ctg_tpr_id']])? $productTypes[$item['ctg_tpr_id']]: NULL,
                'addon' => json_encode($item),
            ]);
        }

    }
}
