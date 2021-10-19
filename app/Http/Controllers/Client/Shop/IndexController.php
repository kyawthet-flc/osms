<?php

namespace App\Http\Controllers\Client\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Client\Shop;

class IndexController extends Controller
{
    protected $baseViewPath = 'clients.shops.';

    public function index()
    {
        return $this->toView('index',[
            'lists' => auth()->user()->shops()->paginate(1)
            // 'lists' => auth()->user()->shops()->with(['township', 'district', 'division'])->paginate(1)
        ]);
    }

    public function show()
    {
        return $this->toView('show');        
    }
}