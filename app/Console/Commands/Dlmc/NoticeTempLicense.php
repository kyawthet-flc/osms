<?php

namespace App\Console\Commands\Dlmc;

use Illuminate\Console\Command;
use App\Console\Commands\CommonTrait;
use DB;
use App\Model\Task\Frontend\{
    User as FrontendUser,
    GlobalMessage
};
use App\Notifications\Dlmc\{
    NoticeTempLicense as TempLicenseMail
};

class NoticeTempLicense extends Command
{
    use CommonTrait {
        CommonTrait::__construct as commonConstructor;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dlmc:notice-temp-license';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notice Temporary License!';
    protected $applicaionModuleId = 4;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->commonConstructor();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $applicationTypes = array('new', 'renew');
        $numberOfCounts = array(1,2,3,4,5);
            
            foreach ($numberOfCounts as $k => $numberOfCount) {
                
                    $lists = $this->dlmcApplication->whereHas('dlmcActionRecord', function($q) use (&$numberOfCount) {
                        $tlCount = $numberOfCount < 2? 0: $numberOfCount - 1;
                        $q->where('temp_license_counter', $tlCount);
                        $q->whereDate(DB::raw('DATE_ADD(temp_license_at, INTERVAL '.($this->period->licenseApproveDuration($numberOfCount)).')'), "=", now());
                    })
                    ->whereIn('application_type', ['new', 'renew'])
                    ->whereApplicationStatus('license-approved')->get();

                    $lists->load(['frontendUser']);
        
                    if ( count($lists) > 0 ) {
        
                        foreach ($lists as $list) {
                            if( $list->dlmcActionRecord->temp_license_counter < 6)
                            {   
                                $list->dlmcActionRecord->increment('temp_license_counter', 1);
                                // check for the number of time
                                if ($list->dlmcActionRecord->temp_license_counter == 0) {
                                    $numberOfTempLicense = 1 ;
                                } else {
                                    $numberOfTempLicense = $list->dlmcActionRecord->temp_license_counter;
                                }

                                GlobalMessage::create([
                                    'department_type' => 'drug',
                                    'app_type' => $list->application_type,
                                    'app_id' => $list->id,
                                    'application_no' => $list->application_no,
                                    'action_type' => 'approved',
                                    'user_id' => $list->user_id,
                                    'subject' => 'Notice For Temporary License Approved',
                                    'message' => "Application No. ( $list->application_no ) has been ( $numberOfTempLicense ) Months Completed, so you need to send report to fda@gmail.com.",
                                    'redirect_url' => ''
                                ]);

                                $list->frontendUser->notify(
                                    new TempLicenseMail($list, "Notice For Temporary License Approved", "Application No. ( $list->application_no ) has been ( $numberOfTempLicense ) Months Completed, so you need to send report to fda@gmail.com.")
                                );
                            }
                        }
        
                    }
    
            }
    }
}