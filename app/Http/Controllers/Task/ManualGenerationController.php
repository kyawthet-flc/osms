<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Task\Diac\DiacApplication;
use App\Templates\Diac\Certificate as DiacCertificate;

class ManualGenerationController extends Controller
{
    public function diacCertificate(DiacApplication $diacApplication)
    {
        $template = new DiacCertificate($diacApplication);
        $certificateFileId = $template->generate();
    }
}
