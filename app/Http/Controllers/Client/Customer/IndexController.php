<?php

namespace App\Http\Controllers\Client\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $baseViewPath = 'clients.customers.';

    public function index()
    {
        return $this->toView('index');
    }

    public function show()
    {
        
    }
}