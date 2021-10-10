<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\TypeOfAuthorization as ObjTable;

class TypeOfAuthorizationSeeder extends Seeder
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
            array('ctg_tau_id' => '01','ctg_tau_desc' => 'Import','ctg_tau_obs' => '','ctg_tpr_id' => '02','ctg_tau_sta' => '2','ctg_tau_usr' => '803223','ctg_tau_dt' => '2017-07-24 16:39:43'),
            array('ctg_tau_id' => '02','ctg_tau_desc' => 'Manufactur','ctg_tau_obs' => '','ctg_tpr_id' => '02','ctg_tau_sta' => '2','ctg_tau_usr' => '803223','ctg_tau_dt' => '2017-07-24 16:39:51'),
            array('ctg_tau_id' => '03','ctg_tau_desc' => 'Export','ctg_tau_obs' => '','ctg_tpr_id' => '02','ctg_tau_sta' => '2','ctg_tau_usr' => '803223','ctg_tau_dt' => '2017-07-24 16:39:58'),
            array('ctg_tau_id' => 'MA','ctg_tau_desc' => 'Full marketing authorization','ctg_tau_obs' => '','ctg_tpr_id' => '02','ctg_tau_sta' => '1','ctg_tau_usr' => '803223','ctg_tau_dt' => '2017-10-16 01:45:25'),
            array('ctg_tau_id' => 'MAH','ctg_tau_desc' => 'Distribution limited to hospitals','ctg_tau_obs' => '','ctg_tpr_id' => '02','ctg_tau_sta' => '1','ctg_tau_usr' => '803223','ctg_tau_dt' => '2017-10-16 01:45:52')
          );

        $productTypes = \App\Model\ProductSetup\ProductType::pluck('id', 'description');

        foreach($items as $item) {
            ObjTable::create([
                'code' => $item['ctg_tau_id'],
                'name' => $item['ctg_tau_desc'],
                'description' => $item['ctg_tau_obs'],
                // 'product_type_id' => 'get from pro type table',
                'product_type_id' => isset($productTypes[$item['ctg_tpr_id']])? $productTypes[$item['ctg_tpr_id']]: NULL,
                'status' => $item['ctg_tau_sta'],
                'addon' => json_encode($item),
            ]);
        }

    }
}
