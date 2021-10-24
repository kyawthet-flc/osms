@extends('layouts.app')

@section('title') My Profile @stop

@section('style')
<style>
  
</style>
@stop

@section('content')
<div class="container" style="margin:40px auto;">  
    <div class="row">      
        <div class="col-md-12 col-md-offset-0">
        <ul>
            <li>
                Product
                <ul>
                    <li>To Sell</li>
                    <li>On Sale</li>
                    <li>Sold Out</li>
                    <li>Total Product</li><br/>
                </ul>
            </li>
            <li>Order
                <ul>
                    <li>Total Order - </li><br/>
                </ul>
            </li>
            <li>Shop
                <ul>
                    <li>Total Shop</li><br/>
                </ul>
            </li>
            <li>Customer
                <ul>
                    <li>Total Customer</li>
                </ul>
            </li>
        </ul>
        </div>
    </div>
</div>

@stop
 
@section('script')

@stop