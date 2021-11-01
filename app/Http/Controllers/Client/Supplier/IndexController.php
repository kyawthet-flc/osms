<?php

namespace App\Http\Controllers\Client\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Client\Supplier;

class IndexController extends Controller
{
    protected $baseViewPath = 'clients.suppliers.';

    public function index()
    {
        return $this->toView('index',[
            'lists' => Supplier::with(['township', 'district', 'division'])
            ->paginate()
        ]);
    }

    public function show()
    {
        return $this->toView('show');        
    }
}