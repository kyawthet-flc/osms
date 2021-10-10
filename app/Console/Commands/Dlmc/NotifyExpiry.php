<?php

namespace App\Console\Commands\Dlmc;

use Illuminate\Console\Command;
use App\Console\Commands\Dlmc\Period;

class NotifyExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dlmc:notify-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Expiry!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
