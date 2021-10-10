<?php

use Illuminate\Database\Seeder;
use App\Model\GeneralSetup\Fee;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fees = array(
            array('id' => '1','application_module_id' => '1','type' => 'new','name' => 'Assement Fee','code' => 'assement-fee','amount' => '30000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:56','updated_at' => '2021-09-27 17:52:49'),
            array('id' => '2','application_module_id' => '1','type' => 'new','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:56','updated_at' => '2021-09-27 07:21:56'),
            array('id' => '3','application_module_id' => '1','type' => 'amend','name' => 'Assement Fee','code' => 'assement-fee','amount' => '10000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:56','updated_at' => '2021-09-27 07:21:56'),
            array('id' => '4','application_module_id' => '1','type' => 'amend','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:56','updated_at' => '2021-09-27 07:21:56'),
            array('id' => '5','application_module_id' => '1','type' => 'renew','name' => 'Assement Fee','code' => 'assement-fee','amount' => '30000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:56','updated_at' => '2021-09-27 17:53:05'),
            array('id' => '6','application_module_id' => '1','type' => 'renew','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:56','updated_at' => '2021-09-27 07:21:56'),
            array('id' => '7','application_module_id' => '1','type' => 'extend','name' => 'Assement Fee','code' => 'assement-fee','amount' => '30000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:56','updated_at' => '2021-09-27 07:21:56'),
            array('id' => '8','application_module_id' => '1','type' => 'extend','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:56','updated_at' => '2021-09-27 07:21:56'),
            array('id' => '9','application_module_id' => '2','type' => 'new','name' => 'Assement Fee','code' => 'assement-fee','amount' => '300000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:57','updated_at' => '2021-09-27 07:21:57'),
            array('id' => '10','application_module_id' => '2','type' => 'new','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:57','updated_at' => '2021-09-27 07:21:57'),
            array('id' => '11','application_module_id' => '2','type' => 'new','name' => 'Registration Fee','code' => 'registration-fee','amount' => '500000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:57','updated_at' => '2021-09-27 07:21:57'),
            array('id' => '12','application_module_id' => '2','type' => 'new','name' => 'Late Charges Fee','code' => 'late-charges-fee','amount' => '300000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:57','updated_at' => '2021-09-27 07:21:57'),
            array('id' => '13','application_module_id' => '2','type' => 'renew','name' => 'Assement Fee','code' => 'assement-fee','amount' => '300000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:57','updated_at' => '2021-09-27 07:21:57'),
            array('id' => '14','application_module_id' => '2','type' => 'renew','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:57','updated_at' => '2021-09-27 07:21:57'),
            array('id' => '15','application_module_id' => '2','type' => 'renew','name' => 'Registration Fee','code' => 'registration-fee','amount' => '500000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:57','updated_at' => '2021-09-27 07:21:57'),
            array('id' => '16','application_module_id' => '2','type' => 'amend','name' => 'Assement Fee','code' => 'assement-fee','amount' => '500000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:57','updated_at' => '2021-09-27 07:21:57'),
            array('id' => '17','application_module_id' => '2','type' => 'amend','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:57','updated_at' => '2021-09-27 07:21:57'),
            array('id' => '18','application_module_id' => '3','type' => 'new','name' => 'Assement Fee','code' => 'assement-fee','amount' => '300000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:57','updated_at' => '2021-09-27 07:21:57'),
            array('id' => '19','application_module_id' => '3','type' => 'new','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '20','application_module_id' => '3','type' => 'renew','name' => 'Assement Fee','code' => 'assement-fee','amount' => '300000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '21','application_module_id' => '3','type' => 'renew','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '22','application_module_id' => '3','type' => 'amend','name' => 'Assement Fee','code' => 'assement-fee','amount' => '500000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '23','application_module_id' => '3','type' => 'amend','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '24','application_module_id' => '4','type' => 'new','name' => 'GMP Assement Fee','code' => 'gmp-assement-fee','amount' => '200000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '25','application_module_id' => '4','type' => 'new','name' => 'SME Assement Fee','code' => 'sme-assement-fee','amount' => '100000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '26','application_module_id' => '4','type' => 'new','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '27','application_module_id' => '4','type' => 'renew','name' => 'GMP Assement Fee','code' => 'gmp-assement-fee','amount' => '200000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '28','application_module_id' => '4','type' => 'renew','name' => 'SME Assement Fee','code' => 'sme-assement-fee','amount' => '100000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '29','application_module_id' => '4','type' => 'renew','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '30','application_module_id' => '4','type' => 'amend','name' => 'Assement Fee','code' => 'assement-fee','amount' => '500000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '31','application_module_id' => '4','type' => 'amend','name' => 'Banking Service Fee','code' => 'banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '32','application_module_id' => '5','type' => 'new','name' => 'Onetime Importation Fee','code' => 'onetime-assement-fee','amount' => '50000','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58'),
            array('id' => '33','application_module_id' => '5','type' => 'new','name' => 'Banking Service Fee','code' => 'onetime-banking-service-fee','amount' => '600','currency' => 'MMK','status' => 'active','created_at' => '2021-09-27 07:21:58','updated_at' => '2021-09-27 07:21:58')
          );

        Fee::truncate();

        foreach($fees as $fee) {
            Fee::create($fee);
        }
    }
}
