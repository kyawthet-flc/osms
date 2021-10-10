<?php

use Illuminate\Database\Seeder;
use App\Model\GeneralSetup\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bank::truncate();
        
        $banks = array(
            [
                'name' => 'Myanma Economic Bank',
            ]
        );

        foreach($banks as $bank) {
            Bank::create($bank);
        }

    }
}
