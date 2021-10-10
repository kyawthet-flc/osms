<?php

namespace App\Console\Commands\Drc;

use Illuminate\Console\Command;
use App\Console\Commands\CommonTrait;
use DB;
use App\Notifications\Drc\AutoCancel as AutoCancelNotification;

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
    protected $signature = 'drc:incomplete-autocancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Incomplete Auto Cancellation!';
    protected $applicaionModuleId = 2;

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
        // \Log::info( $this->description . "\n" );
        $title = 'Auto Cancellation';     
        $applicationTypes = array('new', 'renew', 'amend');

        foreach ($applicationTypes as $key => $applicationType) {

        $lists = $this->drcApplication->whereHas('drcActionRecord', function($q) use (&$applicationType) {
            $q->whereDate(DB::raw('DATE_ADD(incomplete_at, INTERVAL '.($this->period->incompleteDuration($this->applicaionModuleId, $applicationType)).')'), "<", now());
        })->whereApplicationStatus('incomplete')->get();

        // $lists = $this->diacApplication->get();

        $lists->load(['frontendUser', 'drcActionRecord']); 

            foreach ($lists as $list) {

                $msg = "Application No. ".$list->application_no." has been auto-cancelled as it fails to resubmit withing given period.";

                $list->drcComments()->create([
                    'comment_type' => 'system_to_user',
                    'from_officer_id' => NULL,
                    'to_officer_id' => NULL,
                    'title' =>  $title,
                    'comment' => $msg
                ]);

                $this->globalMessage->create([
                    'department_type' => 'drug',
                    'app_type' => 'drc',
                    'app_id' => $list->id,
                    'action_type' => 'auto-cancelled',
                    'user_id' => $list->user_id,
                    'subject' => $title,
                    'message' => $msg,
                    'redirect_url' => ''
                ]);

                $list->update(['application_status' => 'auto-cancelled']);
                $list->drcActionRecord->update(['auto_cancelled_at' => now() ]);
                $list->frontendUser->notify(new AutoCancelNotification($list,  $title, $msg));
            }

        }
    }
}
/* 
incomplete_at
*/