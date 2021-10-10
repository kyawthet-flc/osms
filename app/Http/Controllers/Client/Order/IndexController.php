<?php

namespace App\Http\Controllers\Client\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $baseViewPath = 'clients.orders.';

    public function index()
    {
        return $this->toView('index');
    }

    public function show()
    {
        
    }
}