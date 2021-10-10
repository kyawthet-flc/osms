<?php

namespace App\Templates\Diac;

use App\Traits\MPDFTrait;
use Illuminate\Support\Facades\File;
use App\Model\File as FileModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
// use App\Helpers\{MyanmarDate, TempQrImage };
use Ramsey\Uuid\Uuid;
use QrCode;
use App\Model\Task\Diac\{
    DiacApplication
};

class Certificate
{
    protected $template;
    protected $mpdf;
    protected $diacApplication;

    use MPDFTrait;

    public function __construct(DiacApplication $diacApplication)
    {
        $this->template = File::get(storage_path('templates/diac/new_certificate.html'));
        $configs = [
            'margin_left' => 11,
            // 'margin_header' => 5,
            'margin_right' => 11,
            'margin_top' => 45,
            'margin_bottom' => 5,
            // 'defaultPageNumStyle' => 'myanmar'
        ];
        $this->mpdf = $this->mpdf($configs);

        $this->diacApplication = $diacApplication; 

        $this->prepareCertificate();
        $this->mpdf->shrink_tables_to_fit = 0;
        // $this->mpdf->keep_table_proportions = true;
        // $this->mpdf->SetHTMLHeader('{PAGENO}');
        // $this->mpdf->AddPage('', '', 2);
    }

    protected function prepareCertificate()
    {
        $listBody = '';
         foreach ($this->diacApplication->drugsToBeImported??[] as $key => $drugToBeImported) {
            $nameGroup = $drugToBeImported->brand_name .'<br/> '. $drugToBeImported->generic_name;
            $listBody .= '<tr>
             <td>'.($key+1).'. </td> 
             <td style="font-family: arial;">'.$nameGroup.'</td>
             <td>'. $drugToBeImported->dosage_form .'</td>
             <td>'. $drugToBeImported->presentation .'</td>
             <td>'. $drugToBeImported->manufacturing . '<br/>' . $drugToBeImported->manufacturing .'</td>
             <td>'. $drugToBeImported->manufacturing_country .'</td>
             <td>'. $drugToBeImported->mm_drug_reg_no .'</td>
             <td>'. $drugToBeImported->sale_category .'</td>
             <td>'. $drugToBeImported->storage_condition .'</td>
            </tr>';
        }

        $listContent = '                         
                 <table border="1" class="product-list-page landscape" style="margin-top: 0;width: 1100px;background: transparent">
                <thead>              
                    <tr class="with-border product-list-td-header">
                        <td style="width: 60px;">Sr No.</td>
                        <td>Brand Name<br/> Generic Name</td>
                        <td>Dosage Form</td>
                        <td>Presentation</td>
                        <td>Manufacturer</td>
                        <td>Country of Origin</td>
                        <td>Myanmar Drug Registration No.</td>
                        <td>Sales Category<br/>(POM, OTC etc.)</td>
                        <td >Storage Condition</td>
                    </tr>
                </thead>
                <tbody class="product-list-td-body-wrapper">' . $listBody . '</tbody>
            </table>';

        $issue_date = $this->diacApplication->issue_date;
        $expire_date = $this->diacApplication->expire_date;
        if( is_null($issue_date) && is_null($expire_date) ) {
            [$issue_date, $expire_date] = array_values(temp_issue_expire_date((new \App\Model\GeneralSetup\Period)->validity($this->diacApplication->application_module_id, $this->diacApplication->application_type)));
        } 
        
        $pairs = array(
            'CERTIFICATE_NO' => $this->diacApplication->certificate_no?? 'XXXXXXXXXX',

            'APPLICANT_NAME' => 'APPLICANT_NAME',
            'APPLICANT_DESIGNATION' => 'APPLICANT_DESIGNATION',

            'SUPERVISING_PERSONS' => $this->compileSupervisingPeople(),

            'ISSUE_DATE' => $issue_date,
            'EXPIRE_DATE' => $expire_date,
 
            'LIST' => $listContent, 
            'BACK_SIGNER' => 'Signature',
            'PLACE_OF_STORAGE' => $this->diacApplication->place_of_storage,
            'BUSINESS_NAME' => $this->diacApplication->business_name,
           
            'QR_CODE' => $this->qrImage(),
           /*  'TOTAL_COUNT' => 1,
            'TOTAL_RENEWAL_COUNT' => 1, */
        );

        foreach ($pairs as $replacee => $replacer) {
            $this->template = str_replace("###".$replacee."###", $replacer, $this->template);
        } 

    }

    public function compileSupervisingPeople()
    {
        $tpl = '';
        foreach ($this->diacApplication->diacSupervisingPeople as $key => $person) {
            $tpl .= ($key+1) . '. <span><b>' . $person->name . '('. $person->qualification.')</b></span>';
            if( (count($this->diacApplication->diacSupervisingPeople) -1) > $key){
                $tpl .= '<br/>';
            }
        }
        return $tpl;
    }

    public function qrImage()
    {

        // IR-F/2020-YGN/000259 - 14122020 13122023 913
        $one = substr($this->diacApplication->certificate_no, -1);
        $fined_issue_date = date('dmY', strtotime($this->diacApplication->issue_date));
        $fined_expire_date = date('dmY', strtotime($this->diacApplication->expire_date));
        $second = substr($fined_issue_date, 0, 1);
        $third = substr($fined_expire_date, 1, 1);
        // certificate_no - issue_date  expire_date  first_chr_of_cert_no  fisrtchr-of-issue_date  second-chr-of-expire_date
        $qrText = $this->diacApplication->certificate_no.'-'.$fined_issue_date.$fined_expire_date.$one.$second.$third;

        return '<img src="data:image/png;base64, '.base64_encode(QrCode::errorCorrection('Q')->encoding('UTF-8')->format("png")->size(150)->margin(0)->generate( $qrText )).' ">';
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
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        
        $stylesheet = file_get_contents(asset('css/diac-new-certificate.css'),  false, stream_context_create($arrContextOptions));

        $this->mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
 
        $this->mpdf->WriteHTML($this->template, 2);
        $this->mpdf->Output($string);
        // $this->mpdf->Output($string, "I");
        return;
    }
    

    public function download($name)
    {   
        $this->mpdf->WriteHTML($this->template);
        $this->mpdf->Output($name, "D");
        // $this->mpdf->AddPage();
        return;
    }
}