<?php

use Illuminate\Database\Seeder;
use App\Model\AccountSetup\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array([
            'id' => 1,
            'name' => 'Admin',
            'description' => 'For setting up all setup data.'
        ],[
            'id' => 2,
            'name' => 'Officer',
            'description' => 'For enforcement section.'
        ],[
            'id' => 3,
            'name' => 'Lab User',
            'description' => 'For Lab section.'
        ],[
            'id' => 4,
            'name' => 'Bank User',
            'description' => 'For budget reporting.'
        ],[
            'id' => 5,
            'name' => 'Watcher',
            'description' => 'For just seeing'
        ],[
            'parent_id' => 2,
            'name' => 'Pharmacist'
        ],[
            'parent_id' => 2,
            'name' => 'Medical Officer'
        ],[
            'parent_id' => 2,
            'name' => 'Assistant Director'
        ],[
            'parent_id' => 2,
            'name' => 'Deputy Director'
        ],[
            'parent_id' => 2,
            'name' => 'Director'
        ],[
            'parent_id' => 2,
            'name' => 'Deputy Director General'
        ],[
            'parent_id' => 2,
            'name' => 'Director General'
        ]);

        Role::truncate();
        foreach($roles as $role) {
            Role::create($role);
        }
    }
}