<!-- PAGENO: OSMS-026 -->
<div class="col-md-4">
        <x-forms.select-with-callback 
        onchange="window.location.href='{{ url()->current() }}?code={{ $code }}&customer_id='+this.value" :attrs="[
            'class' => 'customer_id order-customer-selection', 
            'name' => 'customer_id', 
            'label' => 'Choose Customer',
            'required' => 'required'
            ]" 
        >
        @foreach($customers as $customer)
        <option dd="sdd" @if(request('customer_id', $order->customer_id) == $customer->id) selected="selected" @endif value="{{ $customer->id }}">
            <b>{{ $customer->name }}</b>
        </option>
        @endforeach
    </x-forms.select-with-key-value>
    <p>Or <a style="font-size:13px;" href="{{ route('order.create',['customer_id' => request('customer_id', $order->customer_id), 'createCustomer' =>'yes', 'code' => $code ]) }}">Create New Customer</a></p>
</div>
@if( request('customer_id', $order->customer_id) )
@php 
    $customer = App\Model\Client\Customer::find(request('customer_id', $order->customer_id));
@endphp
<div class="col-md-8">
    <div class="row">
        <div class="col-md-12">
            <p>Name: <b>{{ $customer->name }}</b></p>
            <p>E-mail: <b>{{ $customer->email }}</b></p>
            <p>Phone: <b>{{ $customer->phone }}</b></p>
            <p>Address: <b>{{ $customer->address }}</b></p>
            <p>City/ District/ Division: <b>{{ $customer->full_address }}</b></p>
        </div>
    </div>
</div>
@endif