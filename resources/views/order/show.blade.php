@extends('layouts.app')

@section('content')


<?php $subTotal = session()->get('sub-total');
$tax = session()->get('tax');
$grandtotal = session()->get('grand-total');
$discounts = session()->get('discounts'); ?>

<?php
$prices = [$subTotal, $tax, $grandtotal];
$EGY = \App\Http\Controllers\ProductController::convert($prices, "EGY");
$EUR = \App\Http\Controllers\ProductController::convert($prices, "EUR");
$conveted = ["EGY" =>$EGY , "EUR" =>$EUR , "USD" =>$prices]
?>


<div class="custom-select-box">
    <select id="basic" class="selectpicker show-tick form-control">
        <option value="USD" selected>$ USD</option>
        <option value="EGY">£ EGY</option>
        <option value="EUR">€ EUR</option>
    </select>
</div>

<div class="row my-5">
    <div class="col-lg-8 col-sm-12"></div>
    <div class="col-lg-4 col-sm-12">
        <div class="order-box">
            <h3>Order summary</h3>
            <div class="d-flex">
                <h4>Sub Total</h4>
                <div class="ml-auto" id="subTotal"> {{ $subTotal }} </div>
            </div>

            <div class="d-flex">
                <h4>Tax</h4>
                <div class="ml-auto" id="tax"> {{ $tax}} </div>
            </div>

            <hr class="my-1">
            <div class="d-flex gr-total">
                <h5>Grand Total</h5>
                <div class="ml-auto h5" id="grandTotal">
                    {{ $grandtotal }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
