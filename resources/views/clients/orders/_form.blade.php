<!-- PAGENO: OSMS-022 -->

@if(request('createCustomer') ==='yes')
    @php 
    $modelCloseUrl = route('order.create',[
        'customer_id' => request('customer_id', $order->customer_id),
        'code' => $code
    ]);
    @endphp
    <!-- Creating New Customer on the fly. -->
    <div class="row justify-content-center pt-3 pb-5">
        @include('clients.orders._ordered_new_customer')
    </div>
@endif

<x-forms.form-tag :attrs="['id' => 'shop-form', 'class' => 'shop-form', 'method' => $method, 'action' => $action ]">
    <div class="row mb-2" style="border:1px solid #dedede;background-color: #efefef;border-radius: 3px;padding: 20px 5px 0;">
        @include('clients.orders._ordered_customer')
    </div>
    <div class="row mb-2 d-noned" style="border:1px solid #dedede;background-color: #efefef;border-radius: 3px;height: auto;min-height: 160px;padding: 20px 5px 0;">
        <!-- Order Variation Box -->
        @include('clients.orders._ordered_variation_box')
        <!-- Order Variation List -->
        @include('clients.orders._ordered_variation_list')
    </div>
    <div class="row mb-2 d-nonde" style="border:1px solid #dedede;background-color: #efefef;border-radius: 3px;padding: 20px 5px 0;">
        @include('clients.orders._ordered_generic')
    </div>
    <x-forms.submit confirmationText='{{ $confirmationText?? "Are you sure to submit?" }}' :attrs="['name' => 'submit', 'class'=> 'common-sb-btn mt-3', 'value' => '', 'placeholder' => '', 'label' => $submitLabel]" />
</x-forms.form-tag>

@section('ijs')
<script>
    var OrderVariation = new OrderProductVariation("{{ route('order.save_product_variations') }}")
    OrderVariation.init(); 

    $(document).on('ready',function () {
        $('.datepicker').datepicker({ 
        format: 'dd-mm-yyyy',
        modal: true
    });
    });
</script>
@endsection