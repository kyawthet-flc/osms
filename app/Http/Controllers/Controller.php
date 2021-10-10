<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $baseViewPath;

    protected $data = array();

    protected function toView($fileName, $data = array())
    {
        return view($this->baseViewPath . $fileName, $this->data + $data);
    }

    protected function jsonResponse($status, $msg, $redirectUrl, $data = array(), $code=200)
    {
        return response()->json([
            'status' => $status,
            'msg' => $msg,
            'redirectUrl' => $redirectUrl,
            'data' =>  $data
        ], $code=200);
    }
}
