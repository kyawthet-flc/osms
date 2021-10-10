<?php

namespace App\Console\Commands\Onetime;

use Illuminate\Console\Command;
use App\Console\Commands\CommonTrait;
use DB;
use App\Notifications\Onetime\{
    AutoCancel
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
    protected $signature = 'onetime:incomplete-autocancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Incomplete Auto Cancel!';
    protected $applicaionModuleId = 5;

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

            $lists = $this->onetimeApplication->whereHas('onetimeActionRecord', function($q) use (&$applicationType) {
                $q->whereDate(DB::raw('DATE_ADD(incomplete_at, INTERVAL '.($this->period->incompleteDuration($this->applicaionModuleId, $applicationType)).')'), "<", now());
            })->whereApplicationStatus('incomplete')->get();

            $lists->load(['frontendUser']);
            if ( count($lists) > 0 ) {
                
                foreach ($lists as $list) {


                    $list->onetimeComments()->create([
                        'comment_type' => 'system_to_user',
                        'from_officer_id' => NUll,
                        'to_officer_id' => NULL,
                        'title' => 'Expired',
                        'comment' => 'Your Onetime Application is Expired.'
                    ]);

                    $list->onetimeActionRecord()->update([
                        'auto_cancelled_at' => now(),
                        'assigned_officer_id' => NULL
                    ]);

                    $this->globalMessage->create([
                        'department_type' => 'drug',
                        'app_type' => 'diac',
                        'app_id' => $list->id,
                        'action_type' => 'auto-cancelled',
                        'user_id' => $list->user_id,
                        'subject' => 'Expired',
                        'message' => 'Your Onetime Application is Expired.',
                        'redirect_url' => ''
                    ]);
        
                    $list->update(['application_status' => 'auto-cancelled']);

                    // Emailing to User
                    $list->frontendUser->notify(
                        new AutoCancel($list, "Application No. ".$list->application_no." has been auto-cancelled as it fails to resubmit withing given period.")
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