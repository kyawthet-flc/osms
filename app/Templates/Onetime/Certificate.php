<?php

namespace App\Templates\Onetime;

use App\Traits\MPDFTrait;
use Illuminate\Support\Facades\File;
use App\Model\File as FileModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
// use App\Helpers\{MyanmarDate, TempQrImage };
use Ramsey\Uuid\Uuid;
use QrCode;
use App\Model\Task\Onetime\{
    OnetimeApplication
};

class Certificate
{
    protected $template;
    protected $mpdf;
    protected $onetimeApplication;

    use MPDFTrait;

    public function __construct(OnetimeApplication $onetimeApplication)
    {
        $this->onetimeApplication = $onetimeApplication; 
        if($onetimeApplication->type_of_procedure == "Special Access") {
            $t_o_p = "special";
        } elseif($onetimeApplication->type_of_procedure == "During DRC Renewal") {
            $t_o_p = "drc";
        } elseif($onetimeApplication->type_of_procedure == "During DIAC Renewal") {
            $t_o_p = "diac";
        } else {
            $t_o_p = "new";
        }
        $this->template = File::get(storage_path('templates/onetime/'.$t_o_p.'_certificate.html'));
        $configs = [
            'margin_left' => 11,
            // 'margin_header' => 5,
            'margin_right' => 11,
            'margin_top' => 45,
            'margin_bottom' => 5,
            // 'defaultPageNumStyle' => 'myanmar'
        ];
        $this->mpdf = $this->mpdf($configs);

        

        $this->prepareCertificate();
        $this->mpdf->shrink_tables_to_fit = 0;
        // $this->mpdf->keep_table_proportions = true;
        // $this->mpdf->SetHTMLHeader('{PAGENO}');
        // $this->mpdf->AddPage('', '', 2);
    }

    protected function prepareCertificate()
    {
        $onetimeApplication = $this->onetimeApplication;
        $certificateNo = $onetimeApplication->certificate_no?? Null;
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

        $listBody = '';
        foreach ($onetimeApplication->onetimeProductLists??[] as $key => $oneP) {
       $drc = ($oneP->me == "m") ? $oneP->drc_c_no : ($oneP->drcApplication ? $oneP->drcApplication->certificate_no : '');
           
            $listBody .= '<tr>
            <td class="body-td-1">'.($key+1).'. </td> 
            <td class="body-td-2">'. $oneP->brand_name .'</td>
            <td class="body-td-3">'. $drc .'</td>
            <td class="body-td-4">'. $oneP->presentation .'</td>
            <td class="body-td-5">'. $oneP->quantity .'</td>
           </tr>';
       }
       $listContent = '                         
                <table class="product-list-page landscape" width="100%" style="margin-top: 0;">
               <thead>              
                   <tr class="with-border product-list-td-header">
                       <td class="header-td-1 text-bold">စဉ်</td>
                       <td class="header-td-2 text-bold">ဆေးဝါးအမည်</td>
                       <td class="header-td-3 text-bold">ဆေးဝါးမှတ်ပုံတင်အမှတ် </td>
                       <td class="header-td-4 text-bold">Pack Size</td>
                       <td class="header-td-5 text-bold">ပမာဏ</td>
                   </tr>
               </thead>
               <tbody class="product-list-td-body-wrapper">' . $listBody . '</tbody>
           </table>';
       $diac = ($onetimeApplication->me == "m") ? $onetimeApplication->diac_c_no : ($onetimeApplication->diacApplication ? $onetimeApplication->diacApplication->certificate_no : '');
        $pairs = array(
            'CERTIFICATE_NO' => $certificateNo,
            'APPLICATION_NO' =>  $onetimeApplication->application_no,
            'COMPANY_NAME' => $onetimeApplication->user->isBusinessCompany() ? $onetimeApplication->user->businessTypeCompany->company_name_eng : $onetimeApplication->user->businessTypeOther->company_name_eng,
            'APPLICANT_DESIGNATION' => $onetimeApplication->importer_designation,
            'IMPORTER_ADDRESS' => $onetimeApplication->address_1,
            'ISSUE_DATE' => $onetimeApplication->issue_date,
            'DRC' => '',
            'DIAC' => $diac,
            'VALIDATION_YEAR' => '2 Years',
            'DATE' =>  date("Y-m-d"),
            'EXPIRE_DATE' => $onetimeApplication->expire_date,
 
            'PRODUCT_LISTS' => $listContent, 
            'BACK_SIGNER' => null,
            'APPROVED_ITEM_COUNT' => count($onetimeApplication->onetimeProductLists),
           
            // 'QR_CODE' => '',//base64_encode(QrCode::format('png')->size(500)->generate($qrText)),
            'QR_CODE' => $this->qrImage(),
            'TOTAL_COUNT' => $onetimeApplication->onetimeProductLists ? count($onetimeApplication->onetimeProductLists) : 0,
            'TOTAL_RENEWAL_COUNT' => 1,
        );

        foreach ($pairs as $replacee => $replacer) {
            $this->template = str_replace("###".$replacee."###", $replacer, $this->template);
        } 

    }
    public function qrImage()
    {

        // IR-F/2020-YGN/000259 - 14122020 13122023 913
        $one = substr($this->onetimeApplication->certificate_no, -1);
        $fined_issue_date = date('dmY', strtotime($this->onetimeApplication->issue_date));
        $fined_expire_date = date('dmY', strtotime($this->onetimeApplication->expire_date));
        $second = substr($fined_issue_date, 0, 1);
        $third = substr($fined_expire_date, 1, 1);
        // certificate_no - issue_date  expire_date  first_chr_of_cert_no  fisrtchr-of-issue_date  second-chr-of-expire_date
        $qrText = $this->onetimeApplication->certificate_no.'-'.$fined_issue_date.$fined_expire_date.$one.$second.$third;

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