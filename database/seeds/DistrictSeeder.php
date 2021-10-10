<?php

use Illuminate\Database\Seeder;
use App\Model\GeneralSetup\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = array(
            array('id' => '1','name' => 'Myitkyina District','name_mm' => 'မြစ်ကြီးနားခရိုင်','division_id' => '1','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 13:54:58'),
            array('id' => '2','name' => 'Mohnyin District','name_mm' => 'မိုးညှင်းခရိုင်','division_id' => '1','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 13:55:20'),
            array('id' => '3','name' => 'Bhamw District','name_mm' => 'ဗန်းမော်ခရိုင်','division_id' => '1','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 13:55:55'),
            array('id' => '4','name' => 'Putao District','name_mm' => 'ပူတာအိုခရိုင်','division_id' => '1','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 13:56:13'),
            array('id' => '5','name' => 'Bhamaw','name_mm' => '','division_id' => '1','created_at' => '2020-12-16 00:11:03','updated_at' => '2020-12-16 00:11:03'),
            array('id' => '6','name' => 'Monywa District','name_mm' => 'မုံရွာခရိုင်','division_id' => '2','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 13:57:42'),
            array('id' => '7','name' => 'Sagaing District','name_mm' => 'စစ်ကိုင်းခရိုင်','division_id' => '2','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 13:57:58'),
            array('id' => '8','name' => 'Shwebo District','name_mm' => 'ရွှေဘိုခရိုင်','division_id' => '2','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 13:58:14'),
            array('id' => '9','name' => 'Katha District','name_mm' => 'ကသာခရိုင်','division_id' => '2','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 13:58:26'),
            array('id' => '10','name' => 'Kale District','name_mm' => 'ကလေးခရိုင်','division_id' => '2','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 13:58:49'),
            array('id' => '11','name' => 'Mawlaik District','name_mm' => 'မော်လိုက်ခရိုင်','division_id' => '2','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 13:59:07'),
            array('id' => '12','name' => 'Khantee District','name_mm' => 'ခန္တီးခရိုင်','division_id' => '2','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 13:59:32'),
            array('id' => '13','name' => 'Homalin District','name_mm' => 'ဟုမ္မလင်းခရိုင်','division_id' => '2','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:00:00'),
            array('id' => '14','name' => 'Tamu District','name_mm' => 'တမူးခရိုင်','division_id' => '2','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:00:14'),
            array('id' => '15','name' => 'Kaw Lin District','name_mm' => 'ကောလင်းခရိုင်','division_id' => '2','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:01:03'),
            array('id' => '16','name' => 'Falam District','name_mm' => 'ဖလမ်းခရိုင်','division_id' => '3','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:01:56'),
            array('id' => '17','name' => 'Mindat District','name_mm' => 'မင်းတပ်ခရိုင်','division_id' => '3','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:03:04'),
            array('id' => '18','name' => 'Thayet District','name_mm' => 'သရက်ခရိုင်','division_id' => '4','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:04:00'),
            array('id' => '19','name' => 'Magwe District','name_mm' => 'မကွေးခရိုင်','division_id' => '4','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:04:19'),
            array('id' => '20','name' => 'Gangaw District','name_mm' => 'ဂန့်ဂေါခရိုင်','division_id' => '4','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:05:04'),
            array('id' => '21','name' => 'Minbu District','name_mm' => 'မင်းဘူးခရိုင်','division_id' => '4','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:05:25'),
            array('id' => '22','name' => 'Pakokku District','name_mm' => 'ပခုက္ကူခရိုင်','division_id' => '4','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:05:42'),
            array('id' => '23','name' => 'Mandalay District','name_mm' => 'မန္တလေးခရိုင်','division_id' => '5','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:06:13'),
            array('id' => '24','name' => 'Myingyan District','name_mm' => 'မြင်းခြံခရိုင်','division_id' => '5','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:06:36'),
            array('id' => '25','name' => 'Kyaukse District','name_mm' => 'ကျောက်ဆည်ခရိုင်','division_id' => '5','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:06:57'),
            array('id' => '26','name' => 'Pyin Oo Lwin District','name_mm' => 'ပြင်ဦးလွင်ခရိုင်','division_id' => '5','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:07:42'),
            array('id' => '27','name' => 'Meikhtila District','name_mm' => 'မိတ္ထီလာခရိုင်','division_id' => '5','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:10:08'),
            array('id' => '28','name' => 'Yamethin District','name_mm' => 'ရမည်းသင်းခရိုင်','division_id' => '5','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:10:27'),
            array('id' => '29','name' => 'Nyaung-U District','name_mm' => 'ညောင်ဦးခရိုင်','division_id' => '5','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:10:59'),
            array('id' => '30','name' => 'Lauk Kaing District','name_mm' => 'လောက်ကိုင်ခရိုင်','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:11:59'),
            array('id' => '31','name' => 'Linkhe District','name_mm' => 'လင်းခေးခရိုင်','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:12:26'),
            array('id' => '32','name' => 'Konelone','name_mm' => '','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2020-12-16 00:11:03'),
            array('id' => '33','name' => 'Konlon','name_mm' => '','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2020-12-16 00:11:03'),
            array('id' => '34','name' => 'Taunggyi District','name_mm' => 'တောင်ကြီးခရိုင်','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:15:11'),
            array('id' => '35','name' => 'Loilem District','name_mm' => 'လွိုင်လင်ခရိုင်','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:15:45'),
            array('id' => '36','name' => 'Muse District','name_mm' => 'မူဆယ်ခရိုင်','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:16:01'),
            array('id' => '37','name' => 'Tachileik District','name_mm' => 'တာချီလိတ်ခရိုင်','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:16:26'),
            array('id' => '38','name' => 'Kyaingtong District','name_mm' => 'ကျိုင်းတုံခရိုင်','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:16:54'),
            array('id' => '39','name' => 'Kyaukme District','name_mm' => 'ကျောက်မဲခရိုင်','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:17:10'),
            array('id' => '40','name' => 'Lashio District','name_mm' => 'လားရှိုးခရိုင်','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:17:23'),
            array('id' => '41','name' => 'Laukking','name_mm' => '','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2020-12-16 00:11:03'),
            array('id' => '42','name' => 'Monghsat District','name_mm' => 'မိုင်းဆတ်ခရိုင်','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:18:21'),
            array('id' => '43','name' => 'Minephat','name_mm' => '','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2020-12-16 00:11:03'),
            array('id' => '44','name' => 'Minepyat','name_mm' => '','division_id' => '6','created_at' => '2020-12-16 00:11:03','updated_at' => '2020-12-16 00:11:03'),
            array('id' => '45','name' => 'Kyaukphyu District','name_mm' => 'ကျောက်ဖြူခရိုင်','division_id' => '7','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:19:23'),
            array('id' => '46','name' => 'Kyaukphyu','name_mm' => '','division_id' => '7','created_at' => '2020-12-16 00:11:03','updated_at' => '2020-12-16 00:11:03'),
            array('id' => '47','name' => 'Maungdaw District','name_mm' => 'မောင်တောခရိုင်','division_id' => '7','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:19:53'),
            array('id' => '48','name' => 'Thandwae District','name_mm' => 'သံတွဲခရိုင်','division_id' => '7','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:20:21'),
            array('id' => '49','name' => 'Sittwe District','name_mm' => 'စစ်တွေခရိုင်','division_id' => '7','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:20:38'),
            array('id' => '50','name' => 'Buteeaung','name_mm' => '','division_id' => '7','created_at' => '2020-12-16 00:11:03','updated_at' => '2020-12-16 00:11:03'),
            array('id' => '51','name' => 'Mrauk-U District','name_mm' => 'မြောက်ဦးခရိုင်','division_id' => '7','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:21:46'),
            array('id' => '52','name' => 'Bago District','name_mm' => 'ပဲခူးခရိုင်','division_id' => '8','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:22:03'),
            array('id' => '53','name' => 'Thayarwaddy District','name_mm' => 'သာယာဝတီခရိုင်','division_id' => '8','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:22:38'),
            array('id' => '54','name' => 'Taungoo District','name_mm' => 'တောင်ငူခရိုင်','division_id' => '8','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:22:53'),
            array('id' => '55','name' => 'Pyay District','name_mm' => 'ပြည်ခရိုင်','division_id' => '8','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:23:07'),
            array('id' => '56','name' => '8156','name_mm' => '','division_id' => '8','created_at' => '2020-12-16 00:11:03','updated_at' => '2020-12-16 00:11:03'),
            array('id' => '57','name' => 'Loikaw District','name_mm' => 'လွိုင်ကော်ခရိုင်','division_id' => '9','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:23:56'),
            array('id' => '58','name' => 'Bawlakhe District','name_mm' => 'ဘော်လခဲခရိုင်','division_id' => '9','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:24:20'),
            array('id' => '59','name' => 'Pathein District','name_mm' => 'ပုသိမ်ခရိုင်','division_id' => '10','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:24:47'),
            array('id' => '60','name' => 'Hinthada District','name_mm' => 'ဟင်္သာတခရိုင်','division_id' => '10','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:25:34'),
            array('id' => '61','name' => 'Maubin District','name_mm' => 'မအူပင်ခရိုင်','division_id' => '10','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:25:53'),
            array('id' => '62','name' => 'Myaungmya District','name_mm' => 'မြောင်းမြခရိုင်','division_id' => '10','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:26:24'),
            array('id' => '63','name' => 'Pharpone District','name_mm' => 'ဖျာပုံခရိုင်','division_id' => '10','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:26:59'),
            array('id' => '64','name' => 'Labutta District','name_mm' => 'လပွတ္တာခရိုင်','division_id' => '10','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:27:48'),
            array('id' => '66','name' => 'Mawlamyine District','name_mm' => 'မော်လမြိုင်ခရိုင်','division_id' => '12','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:28:25'),
            array('id' => '67','name' => 'Thaton District','name_mm' => 'သထုံခရိုင်','division_id' => '12','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:28:44'),
            array('id' => '68','name' => 'Hpa An  District','name_mm' => 'ဘားအံခရို်င','division_id' => '13','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:29:17'),
            array('id' => '69','name' => 'Kawkareik District','name_mm' => 'ကော့ကရိတ်ခရိုင်','division_id' => '13','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:29:52'),
            array('id' => '70','name' => 'Myawaddy District','name_mm' => 'မြဝတီခရို်င','division_id' => '13','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:30:09'),
            array('id' => '71','name' => 'Dawei District','name_mm' => 'ထားဝယ်ခရိုင်','division_id' => '14','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:31:02'),
            array('id' => '72','name' => 'Myeik District','name_mm' => 'မြိတ်ခရိုင်','division_id' => '14','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:31:13'),
            array('id' => '73','name' => 'Kawthaung District','name_mm' => 'ကော့သောင်းခရိုင်','division_id' => '14','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:31:36'),
            array('id' => '74','name' => 'Dewei','name_mm' => '','division_id' => '14','created_at' => '2020-12-16 00:11:03','updated_at' => '2020-12-16 00:11:03'),
            array('id' => '75','name' => 'North District','name_mm' => 'မြောက်ပိုင်းခရိုင်','division_id' => '11','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:33:14'),
            array('id' => '76','name' => 'East District','name_mm' => 'အရှေ့ပိုင်းခရိုင်','division_id' => '11','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:33:39'),
            array('id' => '77','name' => 'South District','name_mm' => 'တောင်ပိုင်းခရိုင်','division_id' => '11','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:34:03'),
            array('id' => '78','name' => 'West District','name_mm' => 'အနောက်ပိုင်းခရိုင်','division_id' => '11','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:34:28'),
            array('id' => '79','name' => 'Dakkhina District','name_mm' => 'ဒက္ခိဏခရိုင်','division_id' => '15','created_at' => '2020-12-16 00:11:03','updated_at' => '2021-01-27 14:35:22')
          );
        
        District::truncate();
        foreach($districts as $list) {
            District::create($list);
        }
    }
}
