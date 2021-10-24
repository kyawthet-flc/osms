<?php

namespace App\Http\Controllers\Client\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Client\OrderRequest;
use App\Model\Client\Order;
use App\Model\GeneralSetup\Township;
use App\Documents\Clients\OrderPdf;
use App\Model\File;

class ActionController extends Controller
{
    protected $baseViewPath = 'clients.documents.';

    public function printOrder(Order $order, $type)
    {
        // <span class="mdi mdi-file-word"></span>
        if ( 'pdf' === $type ) { 
            $doc = (new OrderPdf($order))->save();
            $order->update(['receipt_id' => $doc]);
            return back();
            // return $this->toView('print_order');

        }
        throw new \Exception("Unknown Document Type", 1);
    }

    public function downloadOrder(File $file, $type)
    {
        if ( 'pdf' === $type ) {
            return $file->showFile();
        }
        throw new \Exception("Unknown Document Type", 1);
    }
}