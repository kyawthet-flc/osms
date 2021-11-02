<?php

namespace App\Documents\Clients;

use App\Traits\MPDFTrait;
use Illuminate\Support\Facades\File;
use App\Model\File as FileModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use QrCode;
use App\Model\Client\Order;
use Ramsey\Uuid\Uuid;

class OrderPdf
{
    protected $template;
    protected $mpdf;
    protected $order;

    public $disk = 'osms';

    use MPDFTrait;

    public function __construct(Order $order, $format = 'A4')
    {
        $this->mpdf = $this->mpdf([
            'margin_left' => 10,
            // 'margin_header' => 5,
            'margin_right' => 10,
            'margin_top' => 45,
            'margin_bottom' => 5,
            // 'defaultPageNumStyle' => 'myanmar'
            'mode' => 'utf-8',
            'format' => array(130, 250)
            // 'format' => array(110.25, 130)
        ]);
        $this->order = $order;
        $this->mpdf->shrink_tables_to_fit = 0;
        $this->init();
    }

    protected function init()
    {
        $this->template = view('clients.documents.print_order', ['order' => $this->order])->render();
    }

    // public function qrImage()
    // {

    //     // IR-F/2020-YGN/000259 - 14122020 13122023 913
    //     $one = substr($this->diacApplication->certificate_no, -1);
    //     $fined_issue_date = date('dmY', strtotime($this->diacApplication->issue_date));
    //     $fined_expire_date = date('dmY', strtotime($this->diacApplication->expire_date));
    //     $second = substr($fined_issue_date, 0, 1);
    //     $third = substr($fined_expire_date, 1, 1);
    //     // certificate_no - issue_date  expire_date  first_chr_of_cert_no  fisrtchr-of-issue_date  second-chr-of-expire_date
    //     $qrText = $this->diacApplication->certificate_no.'-'.$fined_issue_date.$fined_expire_date.$one.$second.$third;

    //     return '<img src="data:image/png;base64, '.base64_encode(QrCode::errorCorrection('Q')->encoding('UTF-8')->format("png")->size(150)->margin(0)->generate( $qrText )).' ">';
    // }
 
    public function save()
    {
        $path = storage_path('app' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR);
        $name = 'certificate_' . uniqid();
        $extension = '.pdf';
        $fullPath = 'temp' . DIRECTORY_SEPARATOR . $name . $extension;

        $this->generate($path . $name . $extension);

        $fileContent = Storage::disk('local')->get($fullPath);
        $fileContent = encrypt($fileContent);
        Storage::disk($this->disk)->put('recipts' . DIRECTORY_SEPARATOR . date('Y-m-d') . DIRECTORY_SEPARATOR . $name . $extension, $fileContent);
        Storage::disk('local')->delete($fullPath);
        // (new TempQrImage)->delete( $this->mdeviceApplication->certificate_no . '.png' );

        return FileModel::create([
            'id' => Uuid::uuid4()->toString(),
            'original_name' => $name,
            'file_name' => $name,
            'file_extension' => 'pdf',
            'file_directory' => 'recipts/' . date('Y-m-d'),
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
        $stylesheet = file_get_contents(asset('css/documents/order-pdf.css'),  false, stream_context_create($arrContextOptions));
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