<?php

use Illuminate\Database\Seeder;
use App\Model\GeneralSetup\ApplicationModule;

class ApplicationModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApplicationModule::truncate();

        ApplicationModule::create([
            'code' => 'DIAC',
            'name' => 'DIAC',
        ]);

        ApplicationModule::create([
            'code' => 'DRC',
            'name' => 'DRC',
        ]);

        ApplicationModule::create([
            'code' => 'DRC-LOCAL',
            'name' => 'DRC LOCAL',
        ]);

        ApplicationModule::create([
            'code' => 'DLMC',
            'name' => 'DLMC',
        ]);

        ApplicationModule::create([
            'code' => 'ONETIME',
            'name' => 'ONE TIME',
        ]);
    }
}
