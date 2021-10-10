<?php
namespace App\Templates\Lab\Drc;

use App\Traits\MPDFTrait;
use Illuminate\Support\Facades\File;
use App\Model\Task\Drc\DrcApplication;
use App\Model\LabSection\Microbial;

class PmlCertificate {
    use MPDFTrait;
    protected $mpdf;
    protected $template;
    protected $drcApplication;

    public function __construct(DrcApplication $drcApplication)
    {
        $this->template = File::get(storage_path('templates/lab/drc/pml-certificate.html'));
        $configs = [
            'margin_left' => 11,
            'margin_header' => 13,
            'margin_right' => 11,
            'margin_top' => 60,
            'margin_bottom' => 0,
            // 'defaultPageNumStyle' => 'myanmar'
        ];
        $this->mpdf = $this->mpdf($configs);
        $this->mpdf->shrink_tables_to_fit = 0;
        $this->mpdf->setAutoTopMargin = 'stretch';
        $this->mpdf->setAutoBottomMargin = 'stretch';
        $this->mpdf->shrink_tables_to_fit = 1;
        $this->drcApplication = $drcApplication;
        $this->prepareTemplate();
    }

    protected function labOverview()
    {
        $labOverview = $this->drcApplication->labResult->labPml;        

        return array(
            'SUB_LAB_TITLE' => 'Pharmaceutical Microbiological Laboratory',

            'FORM_NO' => $labOverview->form_no,
            'VERSION_NO' => $labOverview->version_no,
            'EFFECTIVE_DATE' => date('d-m-Y', strtotime($labOverview->effective_at)),
            'SOP_NO' => $labOverview->sop_number,

            'SAMPLE_ID' => $labOverview->sample_id,
            'LABORATORY_NO' => $labOverview->lab_no,
            'CUSTOMER_REFERENCE_NO' => $labOverview->application_no,
            'RESULT_RELEASED_DATE' => $this->formatDate($labOverview->resulted_at, 'd-m-Y'),
            'SAMPLE_RECEIVED_DATE' => $this->formatDate($labOverview->received_at, 'd-m-Y'),
            'DATE_OF_ANALYSIS' => $this->formatDate($labOverview->analysted_at, 'd-m-Y'),
            'BRAND_NAME' => $labOverview->brand_name,
            'BATCH_NO' => $labOverview->batch_lot_no,
            'MFG_DATE' => $this->formatDate($labOverview->manufactured_at, 'd-m-Y'),
            'EXP_DATE' => $this->formatDate($labOverview->expired_at, 'd-m-Y'),   
            'GENERIC_NAME' => $labOverview->generic_name,
            'MANUFACTURER_NAME_ADDRESS' => $labOverview->manufacturer_name . '<br/>' . $labOverview->manufacturer_address,
            'CUSTOMER_NAME_ADDRESS' => $labOverview->customer_name . ', ' . $labOverview->customer_address,
            'PRODUCT_DESCRIPTION_AND_PRESENTATION' => $labOverview->product_desc . '<br/>' . $labOverview->product_presentation,

            'FINAL_REMARK' => $labOverview->final_remark,
            
            'FIRST_SECOND_RESULTS' => $this->firstAndSecondTests(),
            'THIRD_RESULTS' => $this->thirdTests(),
            'FOURTH_RESULTS' => $this->fourthTests(),
            
            'SAT' => 'Satisfactory',
            'SAT_CHECKED' => $this->satisfactorySymbol($labOverview->lab_test_status),
            'UNSAT' => 'Unsatisfactory',
            'UNSAT_CHECKED' => $this->unSatisfactorySymbol($labOverview->lab_test_status),
            'NOCOMMENT' => 'No comment',
            'NOCOMMENT_CHECKED' => $this->noCommentSymbol($labOverview->lab_test_status),
            'ANAB_IMG' => '<img src="'.  asset('images/lab-logo/anab.png') .'" />'
        );
    }

    protected function formatDate($date, $format)
    {
        if( $date ) {
            return date($format, strtotime($date));
        }
        return NULL;
    }

    protected function satisfactorySymbol($result=null)
    {
        return $result === 'satisfactory'? asset('images/lab-logo/checked-checkbox.png'): asset('images/lab-logo/checked-uncheckbox.jpg');
    }

    protected function unSatisfactorySymbol($result=null)
    {
        return $result === 'unsatisfactory'? asset('images/lab-logo/checked-checkbox.png'): asset('images/lab-logo/checked-uncheckbox.jpg');
    }

    protected function noCommentSymbol($result=null)
    {
        return $result === 'nocomment'? asset('images/lab-logo/checked-checkbox.png'): asset('images/lab-logo/checked-uncheckbox.jpg');
    }

    protected function firstAndSecondTests()
    {
        $tpl = NULL;

        $firstArr = array('Bioassay Test' => optional($this->drcApplication->labResult->labPml)->labPmlTestFirsts?? []);
        $secondArr = array('Sterility Test' => optional($this->drcApplication->labResult->labPml)->labPmlTestSeconds?? []);
        $i = 1;
        $mergedArr = array_merge($firstArr, $secondArr);

        foreach ($mergedArr as $testName => $subTests) {
            $tpl .= '<tr>
                <td class="text-left sample-result-index" style="font-size: 14px;font-weight: bold;" colspan="6">'. $this->integerToRoman($i) .'. '. $testName .'</td>
            </tr>';
            foreach ($subTests as $index => $test) {
                $tpl .= '<tr>
                    <td class="text-center sample-result-value" style="font-size: 14px;">' . ($index+1) . '.</td>
                    <td class="text-center sample-result-value" style="font-size: 14px;">'. $test['test_param'] .'</td>
                    <td class="text-center sample-result-value" style="font-size: 14px;">'. $test['result'] .'</td>
                    <td class="text-center sample-result-value" style="font-size: 14px;">'. $test['specification'] .'</td>
                    <td class="text-center sample-result-value" style="font-size: 14px;">'. $test['ref_method'] .'</td>
                    <td class="text-center sample-result-value" style="font-size: 14px;">'. $test['conclusion'] .'</td>
                </tr>';
            }
            $i++;
        }

        return $tpl;
    }

    protected function thirdTests()
    {
        $tpl = NULL;
        $no = 1;
        $tests = optional($this->drcApplication->labResult->labPml)->labPmlTestThirds?? collect([]);

        //Convert ID to Name from Microbial
        $microbials = Microbial::get(['name', 'id'])->keyBy('id')->pluck('name', 'id');

        foreach($tests->groupBy('microbial_id') as $key => $subTests)
        {
            // $tpl .= '<tr><td colspan="6">'.$key.'</td></tr>';

            foreach ($subTests?? [] as $index => $subTest) {
                $tpl .= '<tr>
                    <td class="text-center sample-result-value" style="font-size: 14px;vertical-align: top;">'.($index==0? $no. '.': '').'</td>
                    <td class="text-left sample-result-value" style="font-size: 14px;padding-left: 9px;">'.($index==0? $microbials[$key]?? '' . '<br/>': '').'('. ($index+1) .') '. $subTest['test_param'] .'</td>
                    <td class="text-center sample-result-value" style="font-size: 14px;">'. $subTest['result'] .'</td>
                    <td class="text-center sample-result-value" style="font-size: 14px;">'. $subTest['specification'] .'</td>
                    <td class="text-center sample-result-value" style="font-size: 14px;">'. $subTest['ref_method'] .'</td>
                    <td class="text-center sample-result-value" style="font-size: 14px;">'. $subTest['conclusion'] .'</td>
                </tr>';
            }
            $no++;
        }
        return $tpl;
    }

    protected function fourthTests()
    {
        $tpl = NULL;

        foreach (optional($this->drcApplication->labResult->labPml)->labPmlTestFourths?? [] as $index => $test) {
            $tpl .= '<tr>
                <td class="text-center sample-result-value" style="font-size: 14px;">' . ($index+1) . '.</td>
                <td class="text-center sample-result-value" style="font-size: 14px;">'. $test['mit'] .'</td>
                <td class="text-center sample-result-value" style="font-size: 14px;">'. $test['test_organism'] .'</td>
                <td class="text-center sample-result-value" style="font-size: 14px;">'. $test['exposure_time'] .'</td>
                <td class="text-center sample-result-value" style="font-size: 14px;">'. $test['growth'] .'</td>
            </tr>';
        }

        return $tpl;
    }

    function integerToRoman($integer)
    {
         // Convert the integer into an integer (just to make sure)
         $integer = intval($integer);
         $result = '';
         
         // Create a lookup array that contains all of the Roman numerals.
         $lookup = array('M' => 1000,
         'CM' => 900,
         'D' => 500,
         'CD' => 400,
         'C' => 100,
         'XC' => 90,
         'L' => 50,
         'XL' => 40,
         'X' => 10,
         'IX' => 9,
         'V' => 5,
         'IV' => 4,
         'I' => 1);
         
         foreach($lookup as $roman => $value){
          // Determine the number of matches
          $matches = intval($integer/$value);
         
          // Add the same number of characters to the string
          $result .= str_repeat($roman,$matches);
         
          // Set the integer to be the remainder of the integer and the value
          $integer = $integer % $value;
     }
     
     // The Roman numeral should be built, return it
     return $result;
    }

    public function prepareTemplate()
    {
        foreach ($this->labOverview() as $replacee => $replacer) {
            $this->template = str_replace("##".$replacee."##", $replacer, $this->template);
        } 
    }

    public function generate($string = null)
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );   
        
        $stylesheet1 = file_get_contents(asset('css/lab-sections/lab-certificate.css'), false, stream_context_create($arrContextOptions));
        $stylesheet2 = file_get_contents(asset('css/lab-sections/pml.css'), false, stream_context_create($arrContextOptions));

        $this->mpdf->WriteHTML($stylesheet1, \Mpdf\HTMLParserMode::HEADER_CSS);
        $this->mpdf->WriteHTML($stylesheet2, \Mpdf\HTMLParserMode::HEADER_CSS);
        $this->mpdf->WriteHTML($this->template, 2);
        $this->mpdf->Output($string);
        $this->mpdf->AddPage();
        return;
    }
}