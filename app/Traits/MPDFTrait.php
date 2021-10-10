<?php

namespace App\Traits;

trait MPDFTrait
{
    protected function mpdf($configs = [])
    {
        ini_set("pcre.backtrack_limit", "5000000");
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $mpdf = $mpdf = new \Mpdf\Mpdf(
            [
                'tempDir' => storage_path('app/temp'),
                'fontDir' => array_merge($fontDirs, [
                    public_path('fonts'),
                ]),
                'fontdata' => $fontData + [
                    'pyidaungsu' => [
                        'R' => 'Pyidaungsu-2.5.3_Regular.ttf',
                        'B' => 'Pyidaungsu-2.5.3_Bold.ttf',
                        'useOTL' => 0xFF,
                    ]
                ],
            ] + $configs
        );
        $mpdf->showImageErrors = true;
        $mpdf->useSubstitutions = false;
        // $mpdf->simpleTables = true;
        return $mpdf;
    }
}
