<?php

namespace App\Templates\Dlmc;

use App\Traits\MPDFTrait;
use Illuminate\Support\Facades\File;
use App\Model\File as FileModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
// use App\Helpers\{MyanmarDate, TempQrImage };
use Ramsey\Uuid\Uuid;
// use QrCode;
use App\Model\Task\Dlmc\DlmcApplication;

class TempLicense
{
    protected $template;
    protected $mpdf;
    protected $dlmcApplication;

    use MPDFTrait;

    public function __construct(DlmcApplication $dlmcApplication)
    {
        $this->template = File::get(storage_path('templates/dlmc/temp_license.html'));
        $configs = [
            'margin_left' => 11,
            // 'margin_header' => 5,
            'margin_right' => 11,
            'margin_top' => 10,
            'margin_bottom' => 5,
            // 'defaultPageNumStyle' => 'myanmar'
        ];
        $this->mpdf = $this->mpdf($configs);
        $this->dlmcApplication = $dlmcApplication;

        $this->prepareCertificate();

        $this->mpdf->shrink_tables_to_fit = 0;
        // $this->mpdf->keep_table_proportions = true;
        // $this->mpdf->SetHTMLHeader('{PAGENO}');
        // $this->mpdf->AddPage('', '', 2);
    }

    protected function prepareCertificate()
    {
        $dlmcApplication = $this->dlmcApplication;
        $pairs = array(
            'MANUFACTURER' => $dlmcApplication->manufacturer_name,
            'APPLICATION_NO' => $dlmcApplication->application_no,
            'ISSUE_DATE' => $dlmcApplication->temp_issue_date ??'xx.xx.xxxx',
            'EXPIRE_DATE' => $dlmcApplication->temp_expire_date ??'xx.xx.xxxx',

            // 'QR_CODE' => base64_encode(QrCode::format('png')->size(500)->generate($qrText)),
            'QR_CODE' => '',
            'TOTAL_COUNT' => 1,
            // 'TOTAL_RENEWAL_COUNT' => 1,
        );

        foreach ($pairs as $replacee => $replacer) {
            $this->template = str_replace("###".$replacee."###", $replacer, $this->template);
        }

    }

    public function save()
    {
        $path = storage_path('app' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR);
        $name = 'certificate_' . uniqid();
        $extension = '.pdf';
        $fullPath = 'temp' . DIRECTORY_SEPARATOR . $name . $extension;

        $this->generate($path . $name . $extension);

        $fileContent = Storage::disk('local')->get($fullPath);
        $fileContent = encrypt($fileContent);
        Storage::disk('drug')->put('certificates' . DIRECTORY_SEPARATOR . date('Y-m-d') . DIRECTORY_SEPARATOR . $name . $extension, $fileContent);
        Storage::disk('local')->delete($fullPath);
        // (new TempQrImage)->delete( $this->mdeviceApplication->certificate_no . '.png' );

        return FileModel::create([
            'id' => Uuid::uuid4()->toString(),
            'original_name' => $name,
            'file_name' => $name,
            'file_extension' => 'pdf',
            'file_directory' => 'certificates/' . date('Y-m-d'),
            'content_type' => 'application/pdf',
            'is_encrypted' => 1,
        ])->id;
    }

    public function generate($string = null)
    {
        $this->mpdf->WriteHTML($this->template);
        $this->mpdf->Output($string);
        // $this->mpdf->Output($string, "I");
        $this->mpdf->AddPage();
        return;
    }


    public function download($name)
    {
        $this->mpdf->WriteHTML($this->template);
        $this->mpdf->Output($name, "D");
        $this->mpdf->AddPage();
        return;
    }
}
