<?php

namespace App\Console\Commands\Drc;

use Illuminate\Console\Command;
use App\Console\Commands\CommonTrait;
use App\Notifications\Drc\NoticeExpiry as NoticeExpiryNotifcation;
use DB;

class NoticeExpiry extends Command
{
    use CommonTrait {
        CommonTrait::__construct as commonConstructor;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drc:notice-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $applicaionModuleId = 2;
    protected $description = 'Expiry Notification when the application is about to expire soon.';

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
        $applicationTypes = array('new', 'renew', 'amend');
        $title = 'Expiry Notice Alert.';

        foreach ($applicationTypes as $key => $applicationType) {

            $lists = $this->drcApplication
            ->whereDate(DB::raw('DATE_SUB(expire_date, INTERVAL '.($this->period->noticeExpiry($this->applicaionModuleId, $applicationType)).')'), "<", now())
            ->whereApplicationStatus('expired')->get();

            $lists->load(['frontendUser', 'drcActionRecord']);

            foreach ($lists as $list) {
                
                $msg = "Certificate No. " . $list->certificate_no . " is about to be expired soon.Please renew before it get expired.";

                $list->drcComments()->create([
                    'comment_type' => 'system_to_user',
                    'from_officer_id' => NULL,
                    'to_officer_id' => NULL,
                    'title' => $title,
                    'comment' => $msg
                ]);

                $this->globalMessage->create([
                    'department_type' => 'drug',
                    'app_type' => 'drc',
                    'app_id' => $list->id,
                    'action_type' => 'renewable',
                    'user_id' => $list->user_id,
                    'subject' => $title,
                    'message' => $msg,
                    'redirect_url' => ''
                ]);

                $list->frontendUser->notify(new NoticeExpiryNotifcation($list, $title, $msg));
            }

        }
    }
}
