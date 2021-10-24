<!-- PAGENO: OSMS-023 -->
<div class="col-md-4">
    <x-forms.text-input :attrs="[
        'name' => 'ordered_at', 
        'value' => $order->ordered_at? $order->ordered_at->format('d-m-Y'): '', 
        'required' => 'required',
        'class' => 'datepicker',
        'label' => 'Ordered Date'
        ]" 
    />
</div>
<div class="col-md-4">
    <x-forms.text-input :attrs="[
        'name' => 'delivered_at', 
        'value' => $order->delivered_at? $order->delivered_at->format('d-m-Y'): '', 
        'class' => 'datepicker',
        'label' => 'Delivered Date'
        ]" 
    />
</div>
<div class="col-md-4">
    <x-forms.text-input :attrs="[
        'name' => 'received_at', 
        'value' => $order->received_at? $order->received_at->format('d-m-Y'): '', 
        'class' => 'datepicker',
        'label' => 'Received Date By Customer'
        ]" 
    />
</div>
<div class="col-md-4">
    <x-forms.text-input :attrs="[
        'name' => 'paid_at', 
        'value' => $order->paid_at? $order->paid_at->format('d-m-Y'): '',
        'class' => 'datepicker',
        'label' => 'Payment Date'
        ]" 
    />
</div>
<div class="col-md-4">
    <x-forms.text-input number="yes" :attrs="[
        'name' => 'total_amount', 
        'value' => $order->total_amount, 
        'label' => 'Total Amount',
        'required' => 'required'
        ]" 
    />
</div>
<div class="col-md-4">
    <x-forms.text-input number="yes" :attrs="[
        'name' => 'total_discount', 
        'value' => $order->total_discount, 
        'label' => 'Total Discount'
        ]" 
    />
</div>
<div class="col-md-4">
    <x-forms.radio-input :attrs="[
        'name' => 'status', 
        'checked' => $order->status, 
        'label' => 'Order Status', 
        'list' => $orderStatus,
        'required' => 'required'
        ]" 
    />
</div>
<div class="col-md-4">
    <x-forms.radio-input :attrs="[
        'name' => 'paid_status', 
        'checked' => $order->paid_status, 
        'label' => 'Payment Status', 
        'list' => $paymentStatus,
        'required' => 'required'
        ]" 
    /> 
</div>
<div class="col-md-4">
    <x-forms.select-with-key-value :attrs="[
        'class' => 'product_id', 
        'name' => 'payment_type_id', 
        'selected' => $order->payment_type_id, 
        'label' => 'Choose Payment Type', 
        'list' => $paymentTypes, 
        'required' => 'required'
        ]" 
    />
</div>
<div class="col-md-4">
    <x-forms.text-input number="yes" :attrs="[
        'name' => 'deli_fee', 
        'value' => $order->deli_fee, 
        'label' => 'Delivery Fee',
        'required' => 'required'
        ]" 
    />
</div>
<div class="col-md-4">
    <x-forms.textarea :attrs="[
        'name' => 'remark', 
        'value' => $order->remark
        ]" 
    />
</div>
<input type="hidden" name="redirectUrl" value="{{ url()->full() }}" />