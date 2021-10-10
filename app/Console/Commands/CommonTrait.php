<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\GeneralSetup\Period;
use App\Model\Task\Drc\DrcApplication;
use App\Model\Task\Dlmc\DlmcApplication;
use App\Model\Task\Diac\DiacApplication;
use App\Model\Task\Onetime\OnetimeApplication;
use App\Model\Task\Frontend\GlobalMessage;

trait CommonTrait
{
    protected $period;
    protected $diacApplication;
    protected $drcApplication;
    protected $dlmcApplication;
    protected $onetimeApplication;
    protected $globalMessage;

    public function __construct()
    {
        $this->period = new Period;
        $this->diacApplication = new DiacApplication;
        $this->drcApplication = new DrcApplication;
        $this->dlmcApplication = new DlmcApplication;
        $this->onetimeApplication = new OnetimeApplication;
        $this->globalMessage = new GlobalMessage;
    }
}
