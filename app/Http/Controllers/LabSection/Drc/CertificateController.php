<?php

namespace App\Http\Controllers\LabSection\Drc;

use App\Http\Controllers\Controller;
use App\Model\Task\Drc\{ DrcApplication, DrcActionRecord };
use Illuminate\Http\Request;

use App\Templates\Lab\Drc\{
    BlCertificate,
    PmlCertificate,
    PclCertificate,
    Certificate
};

class CertificateController extends Controller
{
    protected $basePath = 'lab-sections.drc.';

    public function printCertificate()
    {
        return (new Certificate())->generate();
    }

    public function pmlCertificate(DrcApplication $drcApplication)
    {
        return (new PmlCertificate($drcApplication))->generate();
    }

    public function pclCertificate(DrcApplication $drcApplication)
    {
        return (new PclCertificate($drcApplication))->generate();
    }
    
    public function blCertificate(DrcApplication $drcApplication)
    {
        return (new BlCertificate($drcApplication))->generate();
    }
}
