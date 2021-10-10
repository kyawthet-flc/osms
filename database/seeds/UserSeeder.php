<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Model\AccountSetup\RoleUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();

        $users = array(
            array('id' => '1','name' => 'Super Admin','login_id' => 'admin','email' => 'kyawthet@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$qGgKosV68mbvjUQvcnwoAeCDod.UKmBfhAdRu7f3zcYHp3wq/7N5C','ip' => NULL,'login_status' => 'logged_in','status' => 'active','status_reason' => NULL,'log_counter' => '15','remember_token' => NULL,'created_at' => NULL,'updated_at' => '2021-09-27 22:52:09'),
            array('id' => '2','name' => 'PH1','login_id' => 'ph1','email' => 'ph1@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$CA3RfP3iwSLioECatGqEBO29pxjHc55lnxJKjXaUxdejDX/0o7SUm','ip' => NULL,'login_status' => 'logged_out','status' => 'active','status_reason' => NULL,'log_counter' => '10','remember_token' => NULL,'created_at' => '2021-07-26 21:04:04','updated_at' => '2021-09-27 16:53:04'),
            array('id' => '3','name' => 'PH2','login_id' => 'ph2','email' => 'ph2@gmail.colm','email_verified_at' => NULL,'password' => '$2y$10$md8x84qnG9rCkfp2INOLxO6YlRrxtyMpVNqeYwJnYQrg2dqGZPnUa','ip' => NULL,'login_status' => 'logged_out','status' => 'active','status_reason' => NULL,'log_counter' => '14','remember_token' => NULL,'created_at' => '2021-07-27 21:39:23','updated_at' => '2021-09-27 18:44:14'),
            array('id' => '4','name' => 'Director','login_id' => 'director','email' => 'director@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$Z4u91yqXPHA7LGwYuOOQte8obxESmhlTiZY0Is8/OhKLlZZuYQYg.','ip' => NULL,'login_status' => 'logged_in','status' => 'active','status_reason' => NULL,'log_counter' => '27','remember_token' => NULL,'created_at' => '2021-07-29 09:29:05','updated_at' => '2021-09-27 18:51:29'),
            array('id' => '5','name' => 'DD','login_id' => 'dd','email' => 'dd@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$SdhYA2OEs09rfDOq13q1Ae0C.mBCYK832cqMcNAHr9Ep9X7Dt8OXW','ip' => NULL,'login_status' => 'logged_in','status' => 'active','status_reason' => NULL,'log_counter' => '0','remember_token' => NULL,'created_at' => '2021-07-29 11:47:06','updated_at' => '2021-07-29 11:47:06'),
            array('id' => '6','name' => 'AD','login_id' => 'ad','email' => 'ad@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$Ke4PsnQad.LY/smVmKYgOuK7A.1hVzLxxLKmnrwZj9Y3S/CmsyY9a','ip' => NULL,'login_status' => 'logged_out','status' => 'active','status_reason' => NULL,'log_counter' => '5','remember_token' => NULL,'created_at' => '2021-07-29 11:47:42','updated_at' => '2021-09-27 15:30:59'),
            array('id' => '7','name' => 'MO','login_id' => 'mo','email' => 'mo@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$ixFHnUWsEjwQJ3zrV7gC5.c0VR8PZTU9PB4dxlcK6PavhWhlhv53.','ip' => NULL,'login_status' => 'logged_in','status' => 'active','status_reason' => NULL,'log_counter' => '0','remember_token' => NULL,'created_at' => '2021-07-29 11:48:26','updated_at' => '2021-07-29 11:48:26'),
            array('id' => '8','name' => 'DDG','login_id' => 'ddg','email' => 'ddg@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$ixFHnUWsEjwQJ3zrV7gC5.c0VR8PZTU9PB4dxlcK6PavhWhlhv53.','ip' => NULL,'login_status' => 'logged_in','status' => 'active','status_reason' => NULL,'log_counter' => '0','remember_token' => NULL,'created_at' => '2021-07-29 11:48:26','updated_at' => '2021-07-29 11:48:26'),
            array('id' => '9','name' => 'DG','login_id' => 'dg','email' => 'dg@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$ixFHnUWsEjwQJ3zrV7gC5.c0VR8PZTU9PB4dxlcK6PavhWhlhv53.','ip' => NULL,'login_status' => 'logged_out','status' => 'active','status_reason' => NULL,'log_counter' => '16','remember_token' => NULL,'created_at' => '2021-07-29 11:48:26','updated_at' => '2021-09-27 18:51:25'),
            array('id' => '10','name' => 'Lab User','login_id' => 'lab-user','email' => 'labTestUser@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$TfCFVvDZwLJo6wlK4zUfGu4JPdeUQFnltocmx93dIZw.1Y2.vVgSG','ip' => NULL,'login_status' => 'logged_out','status' => 'active','status_reason' => NULL,'log_counter' => '2','remember_token' => NULL,'created_at' => '2021-09-27 05:53:17','updated_at' => '2021-09-27 06:29:03')
        );
        
        User::truncate();

        foreach($users as $user) {
            unset($user['status_reason']);
            User::create($user);
        }

        // $roleUsers = array(
        //     array('id' => '1','user_id' => '2','role_id' => '6','created_at' => NULL,'updated_at' => NULL),
        //     array('id' => '2','user_id' => '1','role_id' => '1','created_at' => NULL,'updated_at' => NULL),
        //     array('id' => '3','user_id' => '3','role_id' => '6','created_at' => NULL,'updated_at' => NULL),
        //     array('id' => '4','user_id' => '4','role_id' => '10','created_at' => NULL,'updated_at' => NULL),
        //     array('id' => '5','user_id' => '5','role_id' => '9','created_at' => NULL,'updated_at' => NULL),
        //     array('id' => '6','user_id' => '6','role_id' => '8','created_at' => NULL,'updated_at' => NULL),
        //     array('id' => '7','user_id' => '7','role_id' => '7','created_at' => NULL,'updated_at' => NULL),
        //     array('id' => '8','user_id' => '8','role_id' => '11','created_at' => NULL,'updated_at' => NULL),
        //     array('id' => '9','user_id' => '9','role_id' => '12','created_at' => NULL,'updated_at' => NULL)
        // );

        // RoleUser::truncate();

        // foreach($roleUsers as $roleUser) {
        //     RoleUser::create($roleUser);
        // }

        \Schema::enableForeignKeyConstraints();
    }
}
