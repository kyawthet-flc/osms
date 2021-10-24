<!DOCTYPE html>
<html lang="en">
<head> 
</head>
<body>

    <htmlpageheader name="pageheader">
        <table cellspacing="0" borderspacing="0" width="100%">
            <tr>
                @if( $order->customer->shop->logo )
                @php 
                  $encrptedImg = base64_encode(App\Model\File::find($order->customer->shop->logo)->decryptFile())
                @endphp>
                <td class="text-left" width="25px">
                    <img src="data:image/png;base64,{{ $encrptedImg }}" alt="logo" width='130px' height='85px'>
                </td>
                @endif
                <td class="align-center text-left" width="85%">
                  <b>{{ $order->customer->shop->name }}</b><br/><span style="font-size: 11px;">: {{ $order->customer->shop->phone }}</span>
                </td>
            </tr>
        </table>
    </htmlpageheader>

    <page size="A4">
         <div class="processing-date-wrapper">            
            <div class="order-no">Order No: <b>{{ $order->code }}</b></div>        
            <div class="date-of-processed">Voucher Date: <b>{{ now()->format('d / m / Y') }}</b></div>
        </div>

        <div class="customer-info-wrapper">
            <table class="customer-table">
                <tr>
                    <td class="customer-table-tdth-left">Customer Name</td>
                    <td>: <b>{{ $order->customer->name }}</b></td>
                </tr>
                <tr>
                    <td class="customer-table-tdth-left">Phone No.</td>
                    <td>: <b>{{ $order->customer->phone }}</b></td>
                </tr>
                <tr>
                    <td class="customer-table-tdth-left">Address</td>
                    <td>: <b>{{ $order->customer->address }}<br/>&nbsp;&nbsp;{{ $order->customer->full_address }}</b></td>
                </tr>
            </table>
        </div>

        <div class="order-detail-wrapper">
            <table class="order-table" border=1>
                <thead>
                    <tr>
                    <td class="text-center" style="width: 30px;">No.</td>
                    <td class="customer-table-tdth-left text-left">Items</td>
                    <td class="customer-table-tdth-left text-center" style="width: 25px;">Qty * Price</td>
                    <td class="customer-table-tdth-left text-center" style="width: 50px;">Amount</td>
                    </tr>
                </thead>
               <tbody>
                   @php
                   $order->load(['orderDetails.subProduct']);
                   @endphp
                   @foreach($order->orderDetails as $od) 
                    <tr>
                        <td class="text-center">122.</td>
                        <td class="text-left"><b>{{ $od->product->name }}</b> ({{ $od->subProduct->size }} / {{ $od->subProduct->color }})</td>
                        <td class="text-center">{{ $od->quantity }} x {{ $od->subProduct->price_sold }}</td>
                        <td class="text-right">{{ $od->quantity * $od->subProduct->price_sold }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="text-center" style="border-right: none;">  Remark:</td>
                        <td class="text-left" style="padding: 10px 5px;border-left: none;">{!! $order->remark !!}</td>
                        <td class="text-center" style="padding: 10px 5px;"><b>Total Amount</b></td>
                        <td class="text-right" style="padding: 10px 5px;"><b>{{ $order->orderDetails->sum('sub_total_price') }}</b></td>
                    </tr>
               </tbody>
            </table>
        </div>

    </page>

     <htmlpagefooter name="footer" style="display:none;">
       {{--  <div class="footer">
            <div class="footer-qr-code">###QR_CODE###</div>
        </div>--}}
        <div class="footer-page-no">{PAGENO}/{nbpg}</div>
    </htmlpagefooter> 

    <htmlpagefooter name="first_footer">
       {{-- <div class="first-footer">
            <div class="first-footer-qr-code">###QR_CODE###</div>
        </div>--}}
        <div class="first-footer-page-no">{PAGENO}/{nbpg}</div>
    </htmlpagefooter>

</body>
</html>
