<?php

namespace App\Console\Commands\Diac;

use Illuminate\Console\Command;
use App\Console\Commands\CommonTrait;
use DB;


class DeleteDraft extends Command
{
    use CommonTrait {
        CommonTrait::__construct as commonConstructor;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'diac:delete-draft';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Draft!';
    protected $applicaionModuleId = 1;

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

        $lists = $this->diacApplication
        ->whereDate(DB::raw('DATE_ADD(created_at, INTERVAL '.($this->period->deleteDraft($this->applicaionModuleId, 'new')).')'), "<", now())
        ->whereApplicationStatus('draft')->get(['id']);
            
        foreach ($lists as $list) {
            $list->update(['status' => 'trash']);
        }
    }
}