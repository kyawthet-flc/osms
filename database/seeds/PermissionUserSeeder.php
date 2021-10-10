<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission_users = array(
            array('id' => '1','user_id' => '3','permission_id' => '1'),
            array('id' => '2','user_id' => '3','permission_id' => '2'),
            array('id' => '3','user_id' => '3','permission_id' => '3'),
            array('id' => '4','user_id' => '3','permission_id' => '4'),
            array('id' => '15','user_id' => '4','permission_id' => '1'),
            array('id' => '16','user_id' => '4','permission_id' => '2'),
            array('id' => '21','user_id' => '4','permission_id' => '7'),
            array('id' => '24','user_id' => '4','permission_id' => '10'),
            array('id' => '29','user_id' => '9','permission_id' => '1'),
            array('id' => '30','user_id' => '9','permission_id' => '2'),
            array('id' => '38','user_id' => '9','permission_id' => '5'),
            array('id' => '39','user_id' => '9','permission_id' => '8'),
            array('id' => '40','user_id' => '4','permission_id' => '3'),
            array('id' => '41','user_id' => '4','permission_id' => '4'),
            array('id' => '42','user_id' => '4','permission_id' => '12'),
            array('id' => '43','user_id' => '4','permission_id' => '13'),
            array('id' => '44','user_id' => '2','permission_id' => '1'),
            array('id' => '45','user_id' => '2','permission_id' => '2'),
            array('id' => '46','user_id' => '2','permission_id' => '3'),
            array('id' => '47','user_id' => '4','permission_id' => '15')
        );

        DB::table('permission_users')->truncate();

        foreach($permission_users as $permissionUser) {
            DB::table('permission_users')->insert([
                'user_id' => $permissionUser['user_id'],
                'permission_id' => $permissionUser['permission_id']
            ]);
        }        
    }
}