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
    NotifyTempLicense as NotifyTempLicenseMail
};

class NotifyTempLicense extends Command
{
    use CommonTrait {
        CommonTrait::__construct as commonConstructor;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dlmc:notify-temp-license';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Temporary License!';
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
            
            foreach ($applicationTypes as $key => $applicationType) {

                $lists = $this->dlmcApplication->whereHas('dlmcActionRecord', function($q) use (&$applicationType, &$numberOfCount) {
                    $q->where('temp_license_counter', 5);
                })
                ->whereDate(DB::raw('DATE_SUB(temp_expire_date, INTERVAL '.($this->period->licenseExpiredDuration($this->applicaionModuleId, $applicationType)).')'), now())
                ->whereApplicationStatus('license-approved')->get();

                $lists->load(['frontendUser']);
    
                if ( count($lists) > 0 ) {
    
                    foreach ($lists as $list) {

                        // 4 is director id
                        $list->dlmcActionRecord->update([
                            'assigned_officer_id' => 4,
                        ]);

                        GlobalMessage::create([
                            'department_type' => 'drug',
                            'app_type' => $list->application_type,
                            'app_id' => $list->id,
                            'application_no' => $list->application_no,
                            'action_type' => 'Expired',
                            'user_id' => $list->user_id,
                            'subject' => 'Notify For Temporary License Expired',
                            'message' => "Application No. ( $list->application_no ) has been expired for Temporary License Certificate within 2 Weeks.",
                            'redirect_url' => ''
                        ]);

                        $list->frontendUser->notify(
                            new NotifyTempLicenseMail($list, "Notify For Temporary License Expired", "Application No. ( $list->application_no ) has been expired for Temporary License Certificate within 2 Weeks.")
                        );

                        $list->dlmcActionRecord->increment('temp_license_counter', 1);
                    }
    
                }
            }
    }
}