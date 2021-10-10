<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\Cause;

class CauseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cause::truncate();
        
        $causes = array(
            array('ctg_cau_id' => 'ART2','ctg_cau_desc' => 'Cause of non-admission according to article 2 EF','ctg_cau_obs' => 'Here is the explanation of the cause.','ctg_cau_dev' => '0','ctg_cau_noa' => '1','ctg_cau_rec' => '0','ctg_cau_can' => '0','ctg_cau_sus' => '0','ctg_cau_ret' => '0','ctg_tpr_id' => '02','ctg_cau_sta' => '2','ctg_cau_usr' => '803223','ctg_cau_dt' => '2017-07-24 16:40:58'),
            array('ctg_cau_id' => 'ART1','ctg_cau_desc' => 'Cause of return according to article 1 EF','ctg_cau_obs' => 'Here is the explanation of the cause.','ctg_cau_dev' => '1','ctg_cau_noa' => '0','ctg_cau_rec' => '0','ctg_cau_can' => '0','ctg_cau_sus' => '0','ctg_cau_ret' => '0','ctg_tpr_id' => '02','ctg_cau_sta' => '2','ctg_cau_usr' => '803223','ctg_cau_dt' => '2017-07-24 16:41:03'),
            array('ctg_cau_id' => 'ART22','ctg_cau_desc' => 'Return of file according to Article 22 of the Law of Commerce.','ctg_cau_obs' => 'Here is the explanation of the cause.','ctg_cau_dev' => '1','ctg_cau_noa' => '0','ctg_cau_rec' => '0','ctg_cau_can' => '0','ctg_cau_sus' => '0','ctg_cau_ret' => '0','ctg_tpr_id' => '02','ctg_cau_sta' => '2','ctg_cau_usr' => '803223','ctg_cau_dt' => '2017-07-24 16:41:41'),
            array('ctg_cau_id' => 'ART3','ctg_cau_desc' => 'Cause of rejection according to article 3 EF','ctg_cau_obs' => 'Here is the explanation of the cause.','ctg_cau_dev' => '0','ctg_cau_noa' => '0','ctg_cau_rec' => '1','ctg_cau_can' => '0','ctg_cau_sus' => '0','ctg_cau_ret' => '0','ctg_tpr_id' => '02','ctg_cau_sta' => '2','ctg_cau_usr' => '803223','ctg_cau_dt' => '2017-07-24 16:41:54'),
            array('ctg_cau_id' => 'ART4','ctg_cau_desc' => 'Cause of cancellation according to article 4 EF','ctg_cau_obs' => 'Here is the explanation of the cause.','ctg_cau_dev' => '0','ctg_cau_noa' => '0','ctg_cau_rec' => '0','ctg_cau_can' => '1','ctg_cau_sus' => '0','ctg_cau_ret' => '0','ctg_tpr_id' => '02','ctg_cau_sta' => '2','ctg_cau_usr' => '803223','ctg_cau_dt' => '2017-07-24 16:42:06'),
            array('ctg_cau_id' => 'ART5','ctg_cau_desc' => 'Cause of suspension according to article 5 EF','ctg_cau_obs' => 'Here is the explanation of the cause.','ctg_cau_dev' => '0','ctg_cau_noa' => '0','ctg_cau_rec' => '0','ctg_cau_can' => '0','ctg_cau_sus' => '1','ctg_cau_ret' => '0','ctg_tpr_id' => '02','ctg_cau_sta' => '2','ctg_cau_usr' => '803223','ctg_cau_dt' => '2017-07-24 16:42:20'),
            array('ctg_cau_id' => 'ART6','ctg_cau_desc' => 'Cause of withdrawal according to article 6 EF','ctg_cau_obs' => 'Here is the explanation of the cause.','ctg_cau_dev' => '0','ctg_cau_noa' => '0','ctg_cau_rec' => '0','ctg_cau_can' => '0','ctg_cau_sus' => '0','ctg_cau_ret' => '1','ctg_tpr_id' => '02','ctg_cau_sta' => '2','ctg_cau_usr' => '803223','ctg_cau_dt' => '2017-07-24 16:42:31'),
            array('ctg_cau_id' => 'INCOMPLETE','ctg_cau_desc' => 'Documentation submitted is incomplete and applicant did not complement it within the assigned deadli','ctg_cau_obs' => '','ctg_cau_dev' => '1','ctg_cau_noa' => '1','ctg_cau_rec' => '1','ctg_cau_can' => '1','ctg_cau_sus' => '1','ctg_cau_ret' => '1','ctg_tpr_id' => '02','ctg_cau_sta' => '1','ctg_cau_usr' => '803223','ctg_cau_dt' => '2017-10-16 01:44:43')
          );
 
        $productTypes = \App\Model\ProductSetup\ProductType::pluck('id', 'description');

        foreach($causes as $item) {
            Cause::create([
                'code' => $item['ctg_cau_id'],
                'description' => $item['ctg_cau_desc'],
                'observance' => $item['ctg_cau_obs'],
                'product_type_id' => isset($productTypes[$item['ctg_tpr_id']])? $productTypes[$item['ctg_tpr_id']]: NULL,
                'addon' => json_encode($item),
            ]);
        }

    }
}
