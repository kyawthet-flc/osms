<?php

namespace App\Http\Controllers\Client\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Client\Customer;

class IndexController extends Controller
{
    protected $baseViewPath = 'clients.customers.';

    public function index()
    {
        return $this->toView('index',[
            // 'lists' => auth()->user()->shops()->paginate(1)
            'lists' => Customer::with(['township', 'district', 'division'])
            ->whereIn('shop_id', auth()->user()->shops->pluck('id')->toArray())
            ->paginate()
            // 'lists' => auth()->user()->shops()->with(['township', 'district', 'division'])->paginate(1)
        ]);
    }

    public function show()
    {
        return $this->toView('show');        
    }
}