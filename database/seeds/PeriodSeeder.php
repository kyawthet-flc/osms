<?php

use Illuminate\Database\Seeder;
use App\Model\GeneralSetup\Period;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Period::truncate();
        
        $periods = array(
            array('id' => '1','application_module_id' => '1','sub_app_type' => 'new','name' => 'Incomplete Duration','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:14:49','updated_at' => '2021-08-04 14:14:49'),
            array('id' => '2','application_module_id' => '1','sub_app_type' => 'amend','name' => 'Incomplete Duration','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:14:59','updated_at' => '2021-08-04 14:14:59'),
            array('id' => '3','application_module_id' => '1','sub_app_type' => 'renew','name' => 'Incomplete Duration','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:15:14','updated_at' => '2021-08-04 14:15:14'),
            array('id' => '4','application_module_id' => '1','sub_app_type' => 'amend','name' => 'Incomplete Counter','period' => '1','period_unit' => NULL,'remark' => NULL,'created_at' => '2021-08-04 14:15:43','updated_at' => '2021-08-04 14:15:43'),
            array('id' => '5','application_module_id' => '1','sub_app_type' => 'new','name' => 'Incomplete Counter','period' => '1','period_unit' => NULL,'remark' => NULL,'created_at' => '2021-08-04 14:15:56','updated_at' => '2021-08-04 14:15:56'),
            array('id' => '6','application_module_id' => '1','sub_app_type' => 'renew','name' => 'Incomplete Counter','period' => '1','period_unit' => NULL,'remark' => NULL,'created_at' => '2021-08-04 14:16:12','updated_at' => '2021-08-04 14:16:12'),
            array('id' => '7','application_module_id' => '1','sub_app_type' => 'amend','name' => 'Validity','period' => '3','period_unit' => 'Year','remark' => NULL,'created_at' => '2021-08-04 14:21:58','updated_at' => '2021-08-04 14:21:58'),
            array('id' => '8','application_module_id' => '1','sub_app_type' => 'new','name' => 'Validity','period' => '3','period_unit' => 'Year','remark' => NULL,'created_at' => '2021-08-04 14:21:58','updated_at' => '2021-08-04 14:21:58'),
            array('id' => '9','application_module_id' => '1','sub_app_type' => 'renew','name' => 'Validity','period' => '3','period_unit' => 'Year','remark' => NULL,'created_at' => '2021-08-04 14:21:58','updated_at' => '2021-08-04 14:21:58'),
            array('id' => '10','application_module_id' => '1','sub_app_type' => 'amend','name' => 'Notify Renewal','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:47:00','updated_at' => '2021-08-04 14:47:00'),
            array('id' => '11','application_module_id' => '1','sub_app_type' => 'new','name' => 'Notify Renewal','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:48:12','updated_at' => '2021-08-04 14:48:12'),
            array('id' => '12','application_module_id' => '1','sub_app_type' => 'renew','name' => 'Notify Renewal','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:48:27','updated_at' => '2021-08-04 14:48:27'),
            array('id' => '13','application_module_id' => '1','sub_app_type' => 'amend','name' => 'Delete Draft','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:50:21','updated_at' => '2021-08-04 14:50:21'),
            array('id' => '14','application_module_id' => '1','sub_app_type' => 'new','name' => 'Delete Draft','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:50:31','updated_at' => '2021-08-04 14:50:31'),
            array('id' => '15','application_module_id' => '1','sub_app_type' => 'renew','name' => 'Delete Draft','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:50:51','updated_at' => '2021-08-04 14:50:51'),

            array('id' => '1','application_module_id' => '2','sub_app_type' => 'new','name' => 'Incomplete Duration','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:14:49','updated_at' => '2021-08-04 14:14:49'),
            array('id' => '2','application_module_id' => '2','sub_app_type' => 'amend','name' => 'Incomplete Duration','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:14:59','updated_at' => '2021-08-04 14:14:59'),
            array('id' => '3','application_module_id' => '2','sub_app_type' => 'renew','name' => 'Incomplete Duration','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:15:14','updated_at' => '2021-08-04 14:15:14'),
            array('id' => '4','application_module_id' => '2','sub_app_type' => 'amend','name' => 'Incomplete Counter','period' => '1','period_unit' => NULL,'remark' => NULL,'created_at' => '2021-08-04 14:15:43','updated_at' => '2021-08-04 14:15:43'),
            array('id' => '5','application_module_id' => '2','sub_app_type' => 'new','name' => 'Incomplete Counter','period' => '1','period_unit' => NULL,'remark' => NULL,'created_at' => '2021-08-04 14:15:56','updated_at' => '2021-08-04 14:15:56'),
            array('id' => '6','application_module_id' => '2','sub_app_type' => 'renew','name' => 'Incomplete Counter','period' => '1','period_unit' => NULL,'remark' => NULL,'created_at' => '2021-08-04 14:16:12','updated_at' => '2021-08-04 14:16:12'),
            array('id' => '7','application_module_id' => '2','sub_app_type' => 'amend','name' => 'Validity','period' => '3','period_unit' => 'Year','remark' => NULL,'created_at' => '2021-08-04 14:21:58','updated_at' => '2021-08-04 14:21:58'),
            array('id' => '8','application_module_id' => '2','sub_app_type' => 'new','name' => 'Validity','period' => '3','period_unit' => 'Year','remark' => NULL,'created_at' => '2021-08-04 14:21:58','updated_at' => '2021-08-04 14:21:58'),
            array('id' => '9','application_module_id' => '2','sub_app_type' => 'renew','name' => 'Validity','period' => '3','period_unit' => 'Year','remark' => NULL,'created_at' => '2021-08-04 14:21:58','updated_at' => '2021-08-04 14:21:58'),
            array('id' => '10','application_module_id' => '2','sub_app_type' => 'amend','name' => 'Notify Renewal','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:47:00','updated_at' => '2021-08-04 14:47:00'),
            array('id' => '11','application_module_id' => '2','sub_app_type' => 'new','name' => 'Notify Renewal','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:48:12','updated_at' => '2021-08-04 14:48:12'),
            array('id' => '12','application_module_id' => '2','sub_app_type' => 'renew','name' => 'Notify Renewal','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:48:27','updated_at' => '2021-08-04 14:48:27'),
            array('id' => '13','application_module_id' => '2','sub_app_type' => 'amend','name' => 'Delete Draft','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:50:21','updated_at' => '2021-08-04 14:50:21'),
            array('id' => '14','application_module_id' => '2','sub_app_type' => 'new','name' => 'Delete Draft','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:50:31','updated_at' => '2021-08-04 14:50:31'),
            array('id' => '15','application_module_id' => '2','sub_app_type' => 'renew','name' => 'Delete Draft','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:50:51','updated_at' => '2021-08-04 14:50:51'),

            array('id' => '16','application_module_id' => '5','sub_app_type' => 'new','name' => 'Delete Draft','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:50:51','updated_at' => '2021-08-04 14:50:51'),
            array('id' => '17','application_module_id' => '5','sub_app_type' => 'new','name' => 'Incomplete Duration','period' => '1','period_unit' => 'Week','remark' => NULL,'created_at' => '2021-08-04 14:50:51','updated_at' => '2021-08-04 14:50:51'),
            array('id' => '18','application_module_id' => '5','sub_app_type' => 'new','name' => 'Incomplete Counter','period' => '1','period_unit' => NULL,'remark' => NULL,'created_at' => '2021-08-04 14:15:43','updated_at' => '2021-08-04 14:15:43'),

            // module id 4
            array('id' => '31','application_module_id' => '4','sub_app_type' => 'new','name' => 'Incomplete Duration','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:14:49','updated_at' => '2021-08-04 14:14:49'),
            array('id' => '32','application_module_id' => '4','sub_app_type' => 'amend','name' => 'Incomplete Duration','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:14:59','updated_at' => '2021-08-04 14:14:59'),
            array('id' => '33','application_module_id' => '4','sub_app_type' => 'renew','name' => 'Incomplete Duration','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:15:14','updated_at' => '2021-08-04 14:15:14'),

            array('id' => '35','application_module_id' => '4','sub_app_type' => 'new','name' => 'Incomplete Counter','period' => '1','period_unit' => NULL,'remark' => NULL,'created_at' => '2021-08-04 14:15:56','updated_at' => '2021-08-04 14:15:56'),
            array('id' => '34','application_module_id' => '4','sub_app_type' => 'amend','name' => 'Incomplete Counter','period' => '1','period_unit' => NULL,'remark' => NULL,'created_at' => '2021-08-04 14:15:43','updated_at' => '2021-08-04 14:15:43'),
            array('id' => '36','application_module_id' => '4','sub_app_type' => 'renew','name' => 'Incomplete Counter','period' => '1','period_unit' => NULL,'remark' => NULL,'created_at' => '2021-08-04 14:16:12','updated_at' => '2021-08-04 14:16:12'),

            array('id' => '38','application_module_id' => '4','sub_app_type' => 'new','name' => 'Validity','period' => '3','period_unit' => 'Year','remark' => NULL,'created_at' => '2021-08-04 14:21:58','updated_at' => '2021-08-04 14:21:58'),
            array('id' => '37','application_module_id' => '4','sub_app_type' => 'amend','name' => 'Validity','period' => '3','period_unit' => 'Year','remark' => NULL,'created_at' => '2021-08-04 14:21:58','updated_at' => '2021-08-04 14:21:58'),
            array('id' => '39','application_module_id' => '4','sub_app_type' => 'renew','name' => 'Validity','period' => '3','period_unit' => 'Year','remark' => NULL,'created_at' => '2021-08-04 14:21:58','updated_at' => '2021-08-04 14:21:58'),

            array('id' => '41','application_module_id' => '4','sub_app_type' => 'new','name' => 'Notify Renewal','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:48:12','updated_at' => '2021-08-04 14:48:12'),
            array('id' => '40','application_module_id' => '4','sub_app_type' => 'amend','name' => 'Notify Renewal','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:47:00','updated_at' => '2021-08-04 14:47:00'),
            array('id' => '42','application_module_id' => '4','sub_app_type' => 'renew','name' => 'Notify Renewal','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:48:27','updated_at' => '2021-08-04 14:48:27'),

            array('id' => '44','application_module_id' => '4','sub_app_type' => 'new','name' => 'Delete Draft','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:50:31','updated_at' => '2021-08-04 14:50:31'),
            array('id' => '43','application_module_id' => '4','sub_app_type' => 'amend','name' => 'Delete Draft','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:50:21','updated_at' => '2021-08-04 14:50:21'),
            array('id' => '45','application_module_id' => '4','sub_app_type' => 'renew','name' => 'Delete Draft','period' => '1','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:50:51','updated_at' => '2021-08-04 14:50:51'),

            array('id' => '46','application_module_id' => '4','sub_app_type' => 'new','name' => 'Temporary Licece Approved','period' => '6','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:50:31','updated_at' => '2021-08-04 14:50:31'),
            array('id' => '48','application_module_id' => '4','sub_app_type' => 'renew','name' => 'Temporary Licece Approved','period' => '6','period_unit' => 'Month','remark' => NULL,'created_at' => '2021-08-04 14:50:51','updated_at' => '2021-08-04 14:50:51'),

            array('id' => '49','application_module_id' => '4','sub_app_type' => 'new','name' => 'Notify License Expired','period' => '2','period_unit' => 'WEEK','remark' => NULL,'created_at' => '2021-08-04 14:50:51','updated_at' => '2021-08-04 14:50:51'),
        );

        foreach($periods as $period) {
            unset($period['id']);
            Period::create($period);
        }

    }
}
