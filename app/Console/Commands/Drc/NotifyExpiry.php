<?php

namespace App\Console\Commands\Drc;

use Illuminate\Console\Command;
use App\Console\Commands\CommonTrait;
use App\Notifications\Drc\NotifyExpiry as NotifyExpiryNotifcation;

class NotifyExpiry extends Command
{
    use CommonTrait {
        CommonTrait::__construct as commonConstructor;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drc:notify-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $applicaionModuleId = 2;
    protected $description = 'Notify that the application is expired.';

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
        $title = 'Expiry Alert.';

        $applicationTypes = array('new', 'renew', 'amend');

        foreach ($applicationTypes as $key => $applicationType) {

            $lists = $this->drcApplication->whereDate('expire_date', '=', date('Y-m-d'))->whereApplicationStatus('approved')->get();

            $lists->load(['frontendUser', 'drcActionRecord']);

            foreach ($lists as $list) {

                $msg = "Certificate No. " . $list->certificate_no . " has been automatically expired.";
               
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
                    'action_type' => 'expired',
                    'user_id' => $list->user_id,
                    'subject' => $title,
                    'message' => $msg,
                    'redirect_url' => ''
                ]);

                $list->frontendUser->notify(new NotifyExpiryNotifcation($list, $title, $msg));
            }

        }
    }
}
