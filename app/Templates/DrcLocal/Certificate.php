<?php

namespace App\Templates\DrcLocal;

use App\Traits\MPDFTrait;
use Illuminate\Support\Facades\File;
use App\Model\File as FileModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
// use App\Helpers\{MyanmarDate, TempQrImage };
use Ramsey\Uuid\Uuid;
use QrCode;
use App\Model\Task\Drc\DrcApplication;

class Certificate
{
    protected $template;
    protected $mpdf;
    protected $drcApplication;

    use MPDFTrait;

    public function __construct(DrcApplication $drcApplication)
    {
        $this->template = File::get(storage_path('templates/drc-local/new_certificate.html'));
        $configs = [
            'margin_left' => 11,
            // 'margin_header' => 5,
            'margin_right' => 11,
            'margin_top' => 45,
            'margin_bottom' => 5,
            // 'defaultPageNumStyle' => 'myanmar'
        ];
        $this->mpdf = $this->mpdf($configs);
        $this->drcApplication = $drcApplication;

        $this->prepareCertificate();
        $this->mpdf->shrink_tables_to_fit = 0;
        // $this->mpdf->keep_table_proportions = true;
        // $this->mpdf->SetHTMLHeader('{PAGENO}');
        // $this->mpdf->AddPage('', '', 2);
    }

    protected function prepareCertificate()
    {
        $drcApplication = $this->drcApplication;
        $certificateNo = $drcApplication->certificate_no;
        $data = $drcApplication->getARelative();

        $pairs = array(
            'APPLICANT_NAME' => $data->full_name ?? NULL,
            'ADDRESS' => $data->domestic_or_foreign == 'Domestic' ? $data->a_full_address : $data->f_full_address,
            'PRODUCT_NAME' => $drcApplication->generic_name,
            'MANUFACTURER' =>  $data->company_code,
            'DOS_FORM' => $drcApplication->dosage_form,
            'PRESENTATION' => $drcApplication->presentation,
            'THE_CATEGORY' => $drcApplication->therapeutic_class,
            'STRENGTH' => $drcApplication->strength,
            'SALE_CATE' => 'APPROVAL_ITEMS',
            'CERTIFICATE' => $certificateNo??'xxxxxxxxxxx',
            'ISSUE_DATE' => $drcApplication->issue_date ??'xx.xx.xxxx',
            'EXPIRE_DATE' => $drcApplication->expire_date ??'xx.xx.xxxx',

            // 'QR_CODE' => '',//base64_encode(QrCode::format('png')->size(500)->generate($qrText)),
            'QR_CODE' => $this->qrImage(),
            'TOTAL_COUNT' => 1,
            'TOTAL_RENEWAL_COUNT' => 1,
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

    public function qrImage()
    {

        // IR-F/2020-YGN/000259 - 14122020 13122023 913
        $one = substr($this->drcApplication->certificate_no, -1);
        $fined_issue_date = date('dmY', strtotime($this->drcApplication->issue_date));
        $fined_expire_date = date('dmY', strtotime($this->drcApplication->expire_date));
        $second = substr($fined_issue_date, 0, 1);
        $third = substr($fined_expire_date, 1, 1);
        // certificate_no - issue_date  expire_date  first_chr_of_cert_no  fisrtchr-of-issue_date  second-chr-of-expire_date
        $qrText = $this->drcApplication->certificate_no.'-'.$fined_issue_date.$fined_expire_date.$one.$second.$third;

        return '<img src="data:image/png;base64, '.base64_encode(QrCode::errorCorrection('Q')->encoding('UTF-8')->format("png")->size(150)->margin(0)->generate( $qrText )).' ">';
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
