<?php

use Illuminate\Database\Seeder;
use App\Model\AccountSetup\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = array(
            ['name' => 'Comment', 'code' => ''],
            ['name' => 'View', 'code' => ''],

            ['name' => 'Incomplete', 'code' => ''],
            ['name' => 'Auto Cancel', 'code' => ''],

            ['name' => 'To Approve', 'code' => ''],
            ['name' => 'Preview Certificate', 'code' => ''],
            ['name' => 'Approve', 'code' => ''],

            ['name' => 'To Reject', 'code' => ''],
            ['name' => 'Preview Rejection', 'code' => ''],
            ['name' => 'Reject', 'code' => ''],

            ['name' => 'Pay Registration Fee', 'code' => ''],

            ['name' => 'Application Reporting', 'code' => ''],
            ['name' => 'Budget Reporting', 'code' => ''],

            ['name' => 'View Approved Certificate', 'code' => ''],

            ['name' => 'Request Lab Result', 'code' => ''],

            ['name' => 'Inspection Notice', 'code' => ''],
            ['name' => 'Pending Inspection', 'code' => ''],
            ['name' => 'Accepting Inspection', 'code' => ''],
            ['name' => 'Approve Payment', 'code' => ''],
            ['name' => 'Approve Temp License', 'code' => '']
        );

        $labActions = array(
            ['name' => 'Check PCL Lab Result', 'code' => ''], // to display checkbox if a user has permission
            ['name' => 'Check PML Lab Result', 'code' => ''], // to display checkbox if a user has permission
            ['name' => 'Check BS Lab Result', 'code' => ''], // to display checkbox if a user has permission

            ['name' => 'Save PCL Lab Result', 'code' => ''], // to dispay save button
            ['name' => 'Save PML Lab Result', 'code' => ''],
            ['name' => 'Save BS Lab Result', 'code' => ''],

            ['name' => 'Print PCL', 'code' => ''],// to display save button
            ['name' => 'Print PML', 'code' => ''],
            ['name' => 'Print BS', 'code' => ''],
            
            ['name' => 'Save Lab Result', 'code' => ''], // to dispay save button as one
            ['name' => 'Send Lab Result', 'code' => ''], // to dispay send button as one
            
            ['name' => 'PML Lab Setup', 'code' => ''],
            ['name' => 'PCL Lab Setup', 'code' => ''],
            ['name' => 'BS Lab Setup', 'code' => '']
        );

        $appModules = array('diac', 'drc', 'drc-local', 'dlmc', 'onetime', 'drc-lab', 'drc-local-lab');

        Permission::truncate();

        foreach($appModules as $appModule) {

            if( in_array($appModule,['drc-lab', 'drc-local-lab'])) {
                foreach($labActions as $action) {
                    Permission::create([
                        'app_module' => $appModule, 
                        'name' => $action['name'],  
                        'code' => !empty($action['code'])? $action['code']: strtolower(replace_space_with_dash($action['name']))
                    ]);
                }
            } else {
                foreach($actions as $action) {
                    Permission::create([
                        'app_module' => $appModule, 
                        'name' => $action['name'],  
                        'code' => !empty($action['code'])? $action['code']: strtolower(replace_space_with_dash($action['name']))
                    ]);
                }
            }

            // $permissions = array([
            //     'app_module' => $appModule,
            //     'name' => 'View'
            // ],[
            //     'app_module' => $appModule,
            //     'name' => 'Approve',
            // ],[
            //     'app_module' => $appModule,
            //     'name' => 'Reject',
            // ],[
            //     'app_module' => $appModule,
            //     'name' => 'Application Reporting'
            // ],[
            //     'app_module' => $appModule,
            //     'name' => 'Finance Reporting'
            // ],[
            //     'app_module' => $appModule,
            //     'name' => 'Lab Result Maker'
            // ],[
            //     'app_module' => $appModule,
            //     'name' => 'Lab Result Viewer'
            // ]);
        }        
    }
}