<?php

use Illuminate\Database\Seeder;
use App\Model\GeneralSetup\Division;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $divisions = base_path('database/seeds/SqlFile/divisions.sql');
        // DB::unprepared(file_get_contents($divisions));
        $divisions = array(
            array('id' => '1','country_id' => '148','name' => 'Kachin State','name_mm' => 'ကချင်ပြည်နယ်','type' => 'State','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','country_id' => '148','name' => 'Sagaing  Region','name_mm' => 'စစ်ကိုင်းတိုင်းဒေသကြီး','type' => 'Division','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','country_id' => '148','name' => 'Chin State','name_mm' => 'ချင်းပြည်နယ်','type' => 'State','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','country_id' => '148','name' => 'Magway Region','name_mm' => 'မကွေးတို်ငးဒေသကြီး','type' => 'Division','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','country_id' => '148','name' => 'Mandalay Region','name_mm' => 'မန္တလေးတိုင်းဒေသကြီး','type' => 'Division','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','country_id' => '148','name' => 'Shan  State','name_mm' => 'ရှမ်းပြည်နယ်','type' => 'State','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','country_id' => '148','name' => 'Rakhine State','name_mm' => 'ရခိုင်ပြည်နယ်','type' => 'State','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','country_id' => '148','name' => 'Bago Region','name_mm' => 'ပဲခူးတိုင်းဒေသကြီး','type' => 'Division','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','country_id' => '148','name' => 'Kayah State','name_mm' => 'ကယားပြည်နယ်','type' => 'State','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','country_id' => '148','name' => 'Ayeyarwaddy Region','name_mm' => 'ဧရာဝတီတိုင်းဒေသကြီး','type' => 'Division','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','country_id' => '148','name' => 'Yangon Region','name_mm' => 'ရန်ကုန်တိုင်းဒေသကြီး','type' => 'Division','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','country_id' => '148','name' => 'Mon  State','name_mm' => 'မွန်ပြည်နယ်','type' => 'State','created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','country_id' => '148','name' => 'Kayin State','name_mm' => 'ကရင်ပြည်နယ်','type' => 'State','created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','country_id' => '148','name' => 'Tanintharyi Region','name_mm' => 'တနင်္သာရီတိုင်းဒေသကြီး','type' => 'Division','created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','country_id' => '148','name' => 'NayPyiTaw','name_mm' => 'နေပြည်တော်ပြည်ထောင်စုနယ်မြေ','type' => 'Division','created_at' => NULL,'updated_at' => NULL)
          );

        Division::truncate();
        foreach($divisions as $list) {
            Division::create($list);
        }
    }
}
