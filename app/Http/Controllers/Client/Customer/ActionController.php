<?php

namespace App\Http\Controllers\Client\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    protected $baseViewPath = 'clients.customers.';

    public function create()
    {
        return $this->toView('create');
    }

    public function store(Request $request)
    {
        // AAAAAAAAA::create( $this->parameters() );        
    }

    public function edit(Request $request)
    {
        return $this->toView('edit');
    }

    public function update(Request $request)
    {
        // AAAAAAAAA::update( $this->parameters() );        
    }

    protected function parameters()
    {
        return [

        ];
    }
}
