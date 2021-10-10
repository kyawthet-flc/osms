<?php

namespace App\Console\Commands\Dlmc;

use Illuminate\Console\Command;
use App\Console\Commands\CommonTrait;
use DB;
use App\Notifications\Dlmc\{
    AutoCancel as AutoCancelMail
};

class IncompleteAutoCancel extends Command
{
    use CommonTrait {
        CommonTrait::__construct as commonConstructor;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dlmc:incomplete-autocancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Incomplete Auto Cancel!';
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
        $applicationTypes = array('new', 'renew', 'amend');

            foreach ($applicationTypes as $key => $applicationType) {

            $lists = $this->dlmcApplication->whereHas('dlmcActionRecord', function($q) use (&$applicationType) {
                $q->whereDate(DB::raw('DATE_ADD(incomplete_at, INTERVAL '.($this->period->incompleteDuration($this->applicaionModuleId, $applicationType)).')'), "<", now());
            })->whereApplicationStatus('incomplete')->get();

            $lists->load(['frontendUser']);

            if ( count($lists) > 0 ) {

                foreach ($lists as $list) {
                    $list->update(['application_status' => 'incomplete']);
                    $list->frontendUser->notify(
                        new AutoCancelMail($list, "Application No. ".$list->application_no." has been auto-cancelled as it fails to resubmit withing given period.")
                    );
                }

            } else {
                // No Auto Cancel Today.
            }

        }
    }
}
/* 
incomplete_at
*/