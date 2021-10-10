<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = array(
            'database/seeds/LabSql/lab_fees.sql',
            'database/seeds/LabSql/microbials.sql',
            'database/seeds/LabSql/reference_methods.sql',
            'database/seeds/LabSql/reference_values.sql',
            'database/seeds/LabSql/sub_microbials.sql',
            'database/seeds/LabSql/test_parameters.sql'
        );

        foreach ($files as $key => $file) {
            $fullFile = base_path($file);
            DB::unprepared(file_get_contents($fullFile));
            dump('Finished inserting (' . $file . ')');
        }
    }
}