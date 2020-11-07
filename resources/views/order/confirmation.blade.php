@extends('layouts.app')

@section('title', 'order')

@section('content')
<?php $subTotal = \App\Http\Controllers\OrderController::discount(); ?>
<div class="card card-body">
    <form action="{{route('orders.store')}}" method="POST">
        @csrf
        <div class="cart-box-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-main table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $tax = session()->get('tax');
                                          $grandtotal = session()->get('grand-total');
                                          $discounts = session()->get('discounts'); ?>

                                    @if(session('orders'))
                                    @foreach(session('orders') as $id => $details)
                                    <tr>
                                        <td class="name-pr">
                                            <a href="#">
                                                {{ $details['product_name'] }}
                                            </a>
                                        </td>
                                        <td class="price-pr">
                                            <p>{{ $details['price'] }}</p>
                                        </td>
                                        <td class="quantity-box">
                                            <p>{{$details['quantity']}}</p>
                                        </td>
                                        <td class="total-pr">
                                            <p>{{ $details['total']}}</p>
                                        </td>
                                        <td class="remove-pr">
                                            <button class="btn btn-danger btn-sm remove hvr-hover" data-id="{{ $id }}"><i class="fa fa-trash-o"></i>Remove</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

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

                        <div class="order-box USD bill">
                            <h3>Order summary</h3>
                            <div class="d-flex">
                                <h4>Sub Total</h4>
                                <div class="ml-auto price">$ {{ $subTotal }} </div>
                            </div>

                            <div class="d-flex">
                                <h4>Tax</h4>
                                <div class="ml-auto price">$ {{ $tax}} </div>
                            </div>

                            <hr class="my-1">
                            <div class="d-flex gr-total">
                                <h5>Grand Total</h5>
                                <div class="ml-auto h5 price"> $ {{ $grandtotal }} </div>
                            </div>
                        </div>

                        <?php $EGPsub = \App\Http\Controllers\OrderController::convert($subTotal, 'EGP');
                        $EGPtax = \App\Http\Controllers\OrderController::convert($tax, 'EGP');
                        $EGPgrand = \App\Http\Controllers\OrderController::convert($grandtotal, 'EGP'); ?>
                        <div class="order-box EGY bill">
                            <h3>Order summary</h3>
                            <div class="d-flex">
                                <h4>Sub Total</h4>
                                <div class="ml-auto price">£ {{ $EGPsub }} </div>
                            </div>

                            <div class="d-flex">
                                <h4>Tax</h4>
                                <div class="ml-auto price">£ {{ $EGPtax}} </div>
                            </div>

                            <hr class="my-1">
                            <div class="d-flex gr-total">
                                <h5>Grand Total</h5>
                                <div class="ml-auto h5 price"> £ {{ $EGPgrand }} </div>
                            </div>
                        </div>

                        <?php $EURsub = \App\Http\Controllers\OrderController::convert($subTotal, 'EUR');
                        $EURtax = \App\Http\Controllers\OrderController::convert($tax, 'EUR');
                        $EURgrand = \App\Http\Controllers\OrderController::convert($grandtotal, 'EUR'); ?>
                        <div class="order-box EUR bill">
                            <h3>Order summary</h3>
                            <div class="d-flex">
                                <h4>Sub Total</h4>
                                <div class="ml-auto price">€ {{ $EURsub }} </div>
                            </div>

                            <div class="d-flex">
                                <h4>Tax</h4>
                                <div class="ml-auto price">€ {{ $EURtax}} </div>
                            </div>

                            <hr class="my-1">
                            <div class="d-flex gr-total">
                                <h5>Grand Total</h5>
                                <div class="ml-auto h5 price"> € {{ $EURgrand }} </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 d-flex shopping-box">
                        <button type="submit" class="ml-auto btn hvr-hover" id="btn-save-order">Checkout</button>
                    </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>
    $(".remove").click(function(e) {
        e.preventDefault();
        var ele = $(this);
        if (confirm("Are you sure")) {
            $.ajax({
                url: '{{ url("remove") }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id")
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    });

    $(function() {
        $("#basic").on("change", function() {
            $(".bill").hide();
            $("." + this.value).show();
        }).change();
    });
</script>
@endsection