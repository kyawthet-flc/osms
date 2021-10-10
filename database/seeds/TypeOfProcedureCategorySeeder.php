<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\TypeOfProcedureCategory as ObjTable;

class TypeOfProcedureCategorySeeder extends Seeder
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
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'GEN','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-07 16:53:54'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'REN15','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-12-06 12:32:30'),
            array('ctg_ttc_id' => 'QUA','ctg_ttc_desc' => 'Quality','ctg_ttc_obs' => '','ctg_tpt_id' => 'REN15','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-12-06 12:32:30'),
            array('ctg_ttc_id' => 'QUA','ctg_ttc_desc' => 'Quality','ctg_ttc_obs' => '','ctg_tpt_id' => 'GEN','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-07 16:53:54'),
            array('ctg_ttc_id' => 'DR','ctg_ttc_desc' => 'Drug Registracion','ctg_ttc_obs' => '','ctg_tpt_id' => 'AO','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-01-08 20:10:27'),
            array('ctg_ttc_id' => '01','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'NLM','ctg_tpr_id' => '07','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-03 12:39:27'),
            array('ctg_ttc_id' => '02','ctg_ttc_desc' => 'Area','ctg_ttc_obs' => '','ctg_tpt_id' => 'NLM','ctg_tpr_id' => '07','ctg_ttc_sta' => '2','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-03 12:39:44'),
            array('ctg_ttc_id' => '03','ctg_ttc_desc' => 'Inspection','ctg_ttc_obs' => '','ctg_tpt_id' => 'NLM','ctg_tpr_id' => '07','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-03 12:39:50'),
            array('ctg_ttc_id' => '01','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'NDI','ctg_tpr_id' => '07','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-09 18:57:57'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'BIO','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-19 01:37:43'),
            array('ctg_ttc_id' => 'CLI','ctg_ttc_desc' => 'Clinical','ctg_ttc_obs' => '','ctg_tpt_id' => 'BIO','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-19 01:37:43'),
            array('ctg_ttc_id' => 'NCLI','ctg_ttc_desc' => 'Non-clinical','ctg_ttc_obs' => '','ctg_tpt_id' => 'BIO','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-19 01:37:43'),
            array('ctg_ttc_id' => 'QUA','ctg_ttc_desc' => 'Quality','ctg_ttc_obs' => '','ctg_tpt_id' => 'BIO','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-19 01:37:43'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'SPE','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-19 01:38:51'),
            array('ctg_ttc_id' => '02','ctg_ttc_desc' => 'Area','ctg_ttc_obs' => '','ctg_tpt_id' => 'NDI','ctg_tpr_id' => '07','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-09 18:57:57'),
            array('ctg_ttc_id' => '03','ctg_ttc_desc' => 'Inspection','ctg_ttc_obs' => '','ctg_tpt_id' => 'NDI','ctg_tpr_id' => '07','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-09 18:57:57'),
            array('ctg_ttc_id' => 'QUA','ctg_ttc_desc' => 'Quality','ctg_ttc_obs' => '','ctg_tpt_id' => 'SPE','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-19 01:38:51'),
            array('ctg_ttc_id' => '01','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'RDI','ctg_tpr_id' => '07','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-09 18:58:05'),
            array('ctg_ttc_id' => '02','ctg_ttc_desc' => 'Area','ctg_ttc_obs' => '','ctg_tpt_id' => 'RDI','ctg_tpr_id' => '07','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-09 18:58:05'),
            array('ctg_ttc_id' => '03','ctg_ttc_desc' => 'Inspection','ctg_ttc_obs' => '','ctg_tpt_id' => 'RDI','ctg_tpr_id' => '07','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-09 18:58:05'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'SRP','ctg_tpr_id' => '10','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-23 15:20:02'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'SRP-IQ','ctg_tpr_id' => '10','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-23 15:21:12'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'SUA','ctg_tpr_id' => '10','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-23 15:21:19'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'SUA-IQ','ctg_tpr_id' => '10','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-23 15:21:25'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'SUR','ctg_tpr_id' => '10','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-04-23 15:21:32'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'PIR','ctg_tpr_id' => '11','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-05-13 20:47:28'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'PAR','ctg_tpr_id' => '12','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-05-13 20:47:51'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'REN14','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-12-06 12:20:51'),
            array('ctg_ttc_id' => 'QUA','ctg_ttc_desc' => 'Quality','ctg_ttc_obs' => '','ctg_tpt_id' => 'REN14','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-12-06 12:20:51'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'NPM','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-19 01:37:26'),
            array('ctg_ttc_id' => 'CLI','ctg_ttc_desc' => 'Clinical','ctg_ttc_obs' => '','ctg_tpt_id' => 'NPM','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-19 01:37:26'),
            array('ctg_ttc_id' => 'NCLI','ctg_ttc_desc' => 'Non-clinical','ctg_ttc_obs' => '','ctg_tpt_id' => 'NPM','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-19 01:37:26'),
            array('ctg_ttc_id' => 'QUA','ctg_ttc_desc' => 'Quality','ctg_ttc_obs' => '','ctg_tpt_id' => 'NPM','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-19 01:37:26'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'FSU','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-19 01:37:59'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'SIR','ctg_tpr_id' => '11','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-05-13 20:47:38'),
            array('ctg_ttc_id' => 'ADM','ctg_ttc_desc' => 'Administrative','ctg_ttc_obs' => '','ctg_tpt_id' => 'SAR','ctg_tpr_id' => '12','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2018-05-13 20:48:02'),
            array('ctg_ttc_id' => 'QUA','ctg_ttc_desc' => 'Quality','ctg_ttc_obs' => '','ctg_tpt_id' => 'FSU','ctg_tpr_id' => '02','ctg_ttc_sta' => '1','ctg_ttc_usr' => '803223','ctg_ttc_dt' => '2017-10-19 01:37:59')
          );

        foreach($items as $item) {
            ObjTable::create([
                'code' => $item['ctg_ttc_id'],
                'name' => $item['ctg_ttc_desc'],
                'description' => $item['ctg_ttc_obs'],
                'proc_type_id' => 'get from type_of_procedures table',
                'product_type_id' => 'get from pro type table',
                'status' => $item['ctg_ttc_sta'],
                'addon' => json_encode($item),
            ]);
        }

    }
}
