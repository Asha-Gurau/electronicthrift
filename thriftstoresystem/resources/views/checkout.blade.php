@extends('layouts.master')
@section('content')
    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
        <input type="hidden" id="amount" name="amount" value="{{ $cart->total }}" required>
        <input type="hidden" id="tax_amount" name="tax_amount" value ="0" required>
        <input type="hidden" id="total_amount" name="total_amount" value="{{ $cart->total }}" required>
        <input type="hidden" id="transaction_uuid" name="transaction_uuid"required>
        <input type="hidden" id="product_code" name="product_code" value ="EPAYTEST" required>
        <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
        <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
        <input type="hidden" id="success_url" name="success_url" value="{{ route('order.store', $cart->id) }}" required>
        <input type="hidden" id="failure_url" name="failure_url" value="https://google.com" required>
        <input type="hidden" id="signed_field_names" name="signed_field_names"
            value="total_amount,transaction_uuid,product_code" required>
        <input type="hidden" id="signature" name="signature" required>
        <input value="pay with eSwewa" type="submit" class="bg-blue-900 text-white px-3 py-1 rounded block w-32 mx-auto">
    </form>



{{-- payment --}}
{{-- <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

    <button id="payment-button" class="bg-blue-900 text-white px-3 py-1 rounded block w-40 mx-auto">Pay with Khalti</button>
    <script>
        var config = {

            "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a390234",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {

                    console.log(payload);
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {

            checkout.show({amount: 1000});
        }
    </script> --}}

{{-- cash on Delivery --}}
    <form action="{{ route('order.storecod') }}" method="POST">
        @csrf
        <input type="hidden" name="cart_id" value="{{ $cart->id }}">
        <input type="submit" value="Cash on Delivery" class="bg-green-600 text-white px-3 py-1 rounded block w-52 mx-auto">
    </form>
    @php
        $transaction_uuid = auth()->id() . time();
        $totalamount = $cart->total;
        $productcode = 'EPAYTEST';
        $datastring =
            'total_amount=' . $totalamount . ',transaction_uuid=' . $transaction_uuid . ',product_code=' . $productcode;
        $secret = '8gBm/:&EnhH.1/q';
        $signature = hash_hmac('sha256', $datastring, $secret, true);
        $signature = base64_encode($signature);
    @endphp
    <script>
        document.getElementById('transaction_uuid').value = '{{ $transaction_uuid }}';
        document.getElementById('signature').value = '{{ $signature }}';
    </script>
@endsection
