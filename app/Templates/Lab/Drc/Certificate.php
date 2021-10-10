<?php
namespace App\Templates\Lab\Drc;

use App\Traits\MPDFTrait;
use Illuminate\Support\Facades\File;

class Certificate {
    use MPDFTrait;
    protected $mpdf;
    protected $template;

    public function __construct()
    {
        $this->template = File::get(storage_path('templates/lab/drc/certificate.html'));
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
        $this->prepareTemplate();
    }

    public function testValues()
    {
        $testValues = NULL;

        foreach ([] as $index => $pclTestValue) {
            $testValues .= '<tr>
                <td class="text-center sample-result-value">' . ($index+1) . '.</td>
                <td class="text-center sample-result-value">xxxx</td>
                <td class="text-center sample-result-value">xxxx</td>
                <td class="text-center sample-result-value">xxxx</td>
                <td class="text-center sample-result-value">xxxx</td>
                <td class="text-center sample-result-value">xxxx</td>
            </tr>';
        }

        return $testValues;

    }

    public function prepareTemplate()
    {
        $pairs = array(
            'FORM_NO' => 'FORM - no',
            'VERSION_NO' => 'VERSION_- NO',
            'EFFECTIVE_DATE' => 'EFFECTIVE - DATE',
            'SOP_NO' => 'sop no',

            'SAMPLE_ID' => 'SAMPLE id',
            'LABORATORY_NO' => 'LABORATORY No',
            'CUSTOMER_REFERENCE_NO' => 'dddddddddd',
            'RESULT_RELEASED_DATE' => 'dddddddddd',
            'SAMPLE_RECEIVED_DATE' => 'dddddddddd',
            'DATE_OF_ANALYSIS' => 'dddddddddd',
            'BRAND_NAME' => 'dddddddddd',
            'BATCH_NO' => 'dddddddddd',
            'MFG_DATE' => 'dddddddddd',
            'EXP_DATE' => 'dddddddddd',
            
            'GENERIC_NAME' => 'dddddddddd',
            'MANUFACTURER_NAME_ADDRESS' => 'dddddddddd',
            'CUSTOMER_NAME_ADDRESS' => 'dddddddddd',
            'PRODUCT_DESCRIPTION_AND_PRESENTATION' => 'dddddddddd',

            'PCL_TEST_VALUES' => $this->testValues(),

            'FINAL_REMARK' => 'dddddddddd',

            'SAT' => 'Satisfactory',
            'SAT_CHECKED' => strtolower('satisfactory') === 'satisfactory'? asset('images/lab-logo/checked-checkbox.png'): asset('images/lab-logo/checked-uncheckbox.jpg'),

            'UNSAT' => 'Unsatisfactory',
            'UNSAT_CHECKED' => strtolower('ss') === 'unsatisfactory'? asset('images/lab-logo/checked-checkbox.png'): asset('images/lab-logo/checked-uncheckbox.jpg'),
            'NOCOMMENT' => 'No comment',
            'NOCOMMENT_CHECKED' => strtolower('sss') === 'nocomment'? asset('images/lab-logo/checked-checkbox.png'): asset('images/lab-logo/checked-uncheckbox.jpg'),

            'ANAB_IMG' => '<img src="'.  asset('images/lab-logo/anab.png') .'" />'
        );

        foreach ($pairs as $replacee => $replacer) {
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
        
        $stylesheet = file_get_contents(asset('css/lab-sections/pcl.css'), false, stream_context_create($arrContextOptions));
        $this->mpdf->WriteHTML($stylesheet, 1);
        $this->mpdf->WriteHTML($this->template, 2);
        $this->mpdf->Output($string);
        $this->mpdf->AddPage();
        return;
    }
}
