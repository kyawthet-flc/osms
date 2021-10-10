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
use App\Model\GeneralSetup\DlmcDosageForm;
class Certificate
{
    protected $template;
    protected $mpdf;
    protected $dlmcApplication;

    use MPDFTrait;

    public function __construct(DlmcApplication $dlmcApplication)
    {
        $this->template = File::get(storage_path('templates/dlmc/new_certificate.html'));
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
        $this->condition();

        $this->mpdf->shrink_tables_to_fit = 0;
        // $this->mpdf->keep_table_proportions = true;
        // $this->mpdf->SetHTMLHeader('{PAGENO}');
        // $this->mpdf->AddPage('', '', 2);
    }

    protected function prepareCertificate()
    {
        $dlmcApplication = $this->dlmcApplication;
        $certificateNo = $dlmcApplication->certificate_no;
        $pairs = array(
            'APPLICANT_NAME' => $dlmcApplication->applicant_name,
            'MANUFACTURER' => $dlmcApplication->manufacturer_name,
            'ADDRESS' => $dlmcApplication->manufacturer_address,
            'CERTIFICATE' => $certificateNo??'xxxxxxxxxxx',
            'ISSUE_DATE' => $dlmcApplication->issue_date ??'xx.xx.xxxx',
            'EXPIRE_DATE' => $dlmcApplication->expire_date ??'xx.xx.xxxx',

            // 'QR_CODE' => base64_encode(QrCode::format('png')->size(500)->generate($qrText)),
            'QR_CODE' => '',
            'TOTAL_COUNT' => 1,
            // 'TOTAL_RENEWAL_COUNT' => 1,
        );

        foreach ($pairs as $replacee => $replacer) {
            $this->template = str_replace("###".$replacee."###", $replacer, $this->template);
        }

    }

    protected function condition()
    {
        $dosageDatas =  json_decode(optional($this->dlmcApplication->dlmcDrugsToProduce)->dosage_form);

        $CONDITION = '';
        $con = '';
        $k=0;
        foreach($dosageDatas as $k => $id)
            {
                $dosageData =  DlmcDosageForm::where('id', $id)->first();
                $chileDatas =  DlmcDosageForm::where('parent_id', $id)->get();

                    $con .= ++$k .' . '. $dosageData->name;
                    foreach($chileDatas as  $chileData)
                    {
                        $con .= '<ul><li>';
                        $con .= $chileData->name;
                        $con .= '</li></ul>';
                    }
                $CONDITION .= '<br>';
            }
                        
        $CONDITION ='
                <div class="row" style="font-size:15px;">
                    <div class="col-md-12">
                    <br>
                        <div style="margin-left:450px;">
                            <p>Licence No. &nbsp;&nbsp;&nbsp;'; $CONDITION .=  $this->dlmcApplication->certificate_no .'
                            Date of Issue &nbsp;&nbsp;&nbsp;'; $CONDITION .=  $this->dlmcApplication->issue_date .'</p>
                        </div>
                    </div>
                    <br>
                    <div style="text-align: center;">
                        <u><b>SCHEDULE</b></u>
                    </div>
                    <p>
                        Authorization to manufacture includes the following dosage form, <br>'.$con.
                    '</p>
                    
                    <div style="text-align: center;">
                        <u><b>CONDITIONS</b></u>
                    </div>
                    <p>
                        1. This Licence is issued subjected to the applicable provisions of National Drug Law and any rules, procedures, orders and directives issued under the law.<br>
                        2. The manufactured pharmaceutical preparations have to be registered with Myanmar Food and Drug Board of Authority, before they are placed on market for sale. <br>
                        3. This Licence shall comply fully with the Good Practices in Manufacture and Quality Control, as recommended by World Health Organization.<br>
                        4. Any contemplated change of ownership, address or expert staffs has to be notified to licensing authority for approval fo such change.
                    </p>
                    <div>
                        <p style="margin-left:470px">For Director General</p>
                        <p style="margin-left:400px">Department of Food and Drug Administration</p>
                    </div>
                    
                </div>';

        $this->template = str_replace("###CONDITION###", $CONDITION , $this->template);
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
