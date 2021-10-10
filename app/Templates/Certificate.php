<?php

namespace App\Templates;

use App\Traits\MPDFTrait;
use Illuminate\Support\Facades\File;
use App\Model\File as FileModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
// use App\Helpers\{MyanmarDate, TempQrImage };
use Ramsey\Uuid\Uuid;
// use QrCode;
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
        $diacApplication = $this->diacApplication;
        $certificateNo = $diacApplication->certificate_no;
       
        /* foreach ($mDeviceLists as $key => $mDeviceList) {

            // $product_name_postifx = $mDeviceList->reference_or_model? '('.$mDeviceList->reference_or_model.')': '';
            // $product_name_postifx .=  $mDeviceList->size? '('.$mDeviceList->size.')': '';
            // $product_name_postifx .=  $mDeviceList->name? '('.$mDeviceList->name.')': '';
            $size = strtolower($mDeviceList->size) ==='nil'? '': '<br/>-' . $mDeviceList->size . '<br/>-';
 
            $productListValueList .= '<tr>
             <td class="body-td-1">' . ($key+1) . '. </td> 
             <td class="body-td-2" style="font-family: arial;">' . $mDeviceList->product_name . ($size) . $mDeviceList->name . '</td>
             <td class="body-td-3">' . $mDeviceList->packaging . '</td>
             <td class="body-td-3">' . (strtolower($mDeviceList->reference_or_model) === 'nil'? '': $mDeviceList->reference_or_model) . '</td>
             <td class="body-td-4">' . $mDeviceList->physical_manufacturer_name . ', ' . optional($mDeviceList->physicalManuCountry)->name . '</td>
            </tr>';
        }

        $productList = '<pagebreak /><table class="product-list-page" width="100%" style="margin-top: 0;">
            <thead>
                <tr>
                    <td class="text-bold text-center" colspan="5"><span>List of Products</span></td>
                </tr>
                <tr>
                    <td class="text-right" style="padding-bottom: 20px;" colspan="5"> Certificate Number: ' . $certificateNo . '</td>
                </tr>
                <tr class="with-border product-list-td-header">
                    <td class="header-td-1">No.</td>
                    <td class="header-td-2">Product Name</td>
                    <td class="header-td-3" width="19%">Pack Size</td>
                    <td class="header-td-3" width="19%">Reference Or Model</td>
                    <td class="header-td-4">Physical Manufacturer’s name and country</td>
                </tr>
            </thead>
            <tbody class="product-list-td-body-wrapper">'
            .$productListValueList.
            '<tr>
                <td class="total-notified-item-td" colspan="5">Total notified items('.$totalNoOfItem.')</td>
            </tr>
            </tbody>
            </table>';

        $companyName = ucwords($mdeviceApplication->company_name);
        $companyAddress = $mdeviceApplication->company_address;

        // dd($companyName, $companyAddress);

        $productName = $mdeviceApplication->sub_grouping_name;

        if ( $mdeviceApplication->application_type === 'individual' ) {
            $productName = $mdeviceApplication->mDeviceLists()->first()->product_name;
        }

     
        // IR-F/2020-YGN/000259 - 14122020 13122023 913 
        $one = substr($this->mdeviceApplication->certificate_no, -1);
        $fined_issue_date = date('dmY', strtotime($this->mdeviceApplication->issue_date));
        $fined_expire_date = date('dmY', strtotime($this->mdeviceApplication->expire_date));
        $second = substr($fined_issue_date, 0, 1);
        $third = substr($fined_expire_date, 1, 1);
        $textToEmbedded = $this->mdeviceApplication->certificate_no.'-'.$fined_issue_date.$fined_expire_date.$one.$second.$third;
        
        $QR_CODE_IMAGE = '<img src="data:image/png;base64, '.base64_encode(QrCode::errorCorrection('Q')->encoding('UTF-8')->format("png")->size(150)->margin(0)->generate($textToEmbedded)).' ">';

        $tempValidity = tempIssueExpireDate(); */
        
        $pairs = array(
            'CERTIFICATE_NO' => $certificateNo,
            'PRODUCT_NAME' => 'PRODUCT_NAME',
            'BRAND_NAME' => 'BRAND_NAME',
            'REFERENCE_NO' =>  $diacApplication->application_no,
            'APPLICANT_NAME' => 'APPLICANT_NAME',
            'APPLICANT_DESIGNATION' => 'APPLICANT_DESIGNATION',
            'COMPANY_NAME' => 'companyName',
            'COMPANY_ADDRESS' => 'companyAddress',
            'APPROVAL_ITEMS' => 'APPROVAL_ITEMS',
            'LEGAL_MANUFACTURER_NAME_AND_COUNTRY' =>'',
            'ISSUE_DATE' => $diacApplication->issue_date,
            'VALIDATION_YEAR' => '2 Years',
            'EXPIRE_DATE' => $diacApplication->expire_date,
 
            'PRODUCT_LISTS' => null, 
            'BACK_SIGNER' => null,
            'APPROVED_ITEM_COUNT' => 0,
           
            // 'QR_CODE' => '',//base64_encode(QrCode::format('png')->size(500)->generate($qrText)),
            'QR_CODE' => '',
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