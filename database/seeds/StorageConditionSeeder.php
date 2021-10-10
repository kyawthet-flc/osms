<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\StorageCondition;

class StorageConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StorageCondition::truncate();
         
        $storage_conditions = array(
            array('ctg_cal_id' => 'COOL','ctg_cal_desc' => 'store between 8 and 15 degrees centigrades','ctg_cal_obs' => '','ctg_tpr_id' => '02','ctg_cal_sta' => '1','ctg_cal_usr' => '803223','ctg_cal_dt' => '2017-09-15 13:56:26'),
            array('ctg_cal_id' => 'ROOM','ctg_cal_desc' => 'store between 15 and 25 degrees centigrades','ctg_cal_obs' => '','ctg_tpr_id' => '02','ctg_cal_sta' => '1','ctg_cal_usr' => '803223','ctg_cal_dt' => '2017-09-15 13:56:45'),
            array('ctg_cal_id' => '2-8','ctg_cal_desc' => 'store between 2 and 8 degrees centigrades','ctg_cal_obs' => '','ctg_tpr_id' => '02','ctg_cal_sta' => '2','ctg_cal_usr' => '803223','ctg_cal_dt' => '2017-09-15 13:57:18'),
            array('ctg_cal_id' => 'FRIDGE','ctg_cal_desc' => 'store between -2 and +2 degree centigrades','ctg_cal_obs' => '','ctg_tpr_id' => '02','ctg_cal_sta' => '1','ctg_cal_usr' => '803223','ctg_cal_dt' => '2017-09-15 13:58:35'),
            array('ctg_cal_id' => 'FROZEN','ctg_cal_desc' => 'store between -10 and -20 degrees centigrades','ctg_cal_obs' => '','ctg_tpr_id' => '02','ctg_cal_sta' => '2','ctg_cal_usr' => '803223','ctg_cal_dt' => '2017-09-15 14:00:16'),
            array('ctg_cal_id' => 'B30','ctg_cal_desc' => 'Store below 30 degrees centigrade','ctg_cal_obs' => '','ctg_tpr_id' => '02','ctg_cal_sta' => '1','ctg_cal_usr' => '803223','ctg_cal_dt' => '2017-10-25 00:41:26'),
            array('ctg_cal_id' => 'COOL','ctg_cal_desc' => 'store between 8 and 15 degrees centigrades','ctg_cal_obs' => '','ctg_tpr_id' => '10','ctg_cal_sta' => '1','ctg_cal_usr' => '803223','ctg_cal_dt' => '2017-09-15 13:56:26'),
            array('ctg_cal_id' => 'ROOM','ctg_cal_desc' => 'store between 15 and 25 degrees centigrades','ctg_cal_obs' => '','ctg_tpr_id' => '10','ctg_cal_sta' => '1','ctg_cal_usr' => '803223','ctg_cal_dt' => '2017-09-15 13:56:45'),
            array('ctg_cal_id' => '2-8','ctg_cal_desc' => 'store between 2 and 8 degrees centigrades','ctg_cal_obs' => '','ctg_tpr_id' => '10','ctg_cal_sta' => '2','ctg_cal_usr' => '803223','ctg_cal_dt' => '2017-09-15 13:57:18'),
            array('ctg_cal_id' => 'FRIDGE','ctg_cal_desc' => 'store between -2 and +2 degree centigrades','ctg_cal_obs' => '','ctg_tpr_id' => '10','ctg_cal_sta' => '1','ctg_cal_usr' => '803223','ctg_cal_dt' => '2017-09-15 13:58:35'),
            array('ctg_cal_id' => 'FROZEN','ctg_cal_desc' => 'store between -10 and -20 degrees centigrades','ctg_cal_obs' => '','ctg_tpr_id' => '10','ctg_cal_sta' => '2','ctg_cal_usr' => '803223','ctg_cal_dt' => '2017-09-15 14:00:16'),
            array('ctg_cal_id' => 'B30','ctg_cal_desc' => 'Store below 30 degrees centigrade','ctg_cal_obs' => '','ctg_tpr_id' => '10','ctg_cal_sta' => '1','ctg_cal_usr' => '803223','ctg_cal_dt' => '2017-10-25 00:41:26')
          );

        foreach ($storage_conditions as $key => $item) {
            StorageCondition::create([
                'name' => $item['ctg_cal_id'],
                'description' => $item['ctg_cal_desc'],
                'observance' => $item['ctg_cal_obs'],
                'addon' => json_encode($item)
            ]);
        }
    }
}