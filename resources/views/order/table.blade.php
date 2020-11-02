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
                            <?php $total = 0 ?>
                            @if(session('orders'))
                                @foreach(session('orders') as $id => $details)
                                <?php $total += $details['price'] * $details['quantity'] ?>
                                <tr>
                                    <td class="name-pr">
                                        <a href="#">
                                            {{ $details['name'] }}
								        </a>
                                    </td>
                                    <td class="price-pr">
                                        <p>{{ $details['price'] }}</p>
                                    </td>
                                    <td class="quantity-box"><input type="number" size="4" value="{{$details['quantity']}}" min="0" step="1" class="c-input-text qty text"></td>
                                    <td class="total-pr">
                                        <p>{{ $details['price'] * $details['quantity'] }}</p>
                                    </td>
                                    <td class="remove-pr">
                                        <a href="#">
									        <i class="fas fa-times"></i>
								        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-6 col-sm-6">
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="update-box">
                    <input value="Update Cart" type="submit">
                </div>
            </div>
        </div>

        <div class="row my-5">
            <div class="col-lg-8 col-sm-12"></div>
            <div class="col-lg-4 col-sm-12">
                <div class="order-box">
                    <h3>Order summary</h3>
                    <div class="d-flex">
                        <h4>Sub Total</h4>
                        <div class="ml-auto font-weight-bold"> {{ $total }} </div>
                    </div>
                    <div class="d-flex">
                        <h4>Discount</h4>
                        <div class="ml-auto font-weight-bold"></div>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex">
                        <h4>Tax</h4>
                        <div class="ml-auto font-weight-bold"> {{ $total * 0.14}} </div>
                    </div>
                    <div class="d-flex">
                        <h4>Shipping Cost</h4>
                        <div class="ml-auto font-weight-bold"> Free </div>
                    </div>
                    <hr>
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5">{{ ($total * 0.14) + $total}}</div>
                    </div>
                    <hr>
                 </div>
            </div>
            <div class="col-12 d-flex shopping-box"><a href="" class="ml-auto btn hvr-hover">Checkout</a> </div>
        </div>
    </div>
</div>



@section('js')
    <script>
        //update-box
        // //removimg row
        // $(document).on('click', '.row-delete', function () {
        //     const rowId = '#' + $(this).attr('row-id');
        //     $(rowId).remove();
        // });

        // //changing the total of the row on changing the quantity
        // $(document).on('keyup', '.input-product-quantity', function () {
        //     const rowId = '#' + $(this).attr('row-id'),
        //         productQuantity = $(this).children("option:selected").data('quantity');
        //         calculateTotal(rowId);
        // });

        // //changing the product price to the selected product price 
        // $(document).on('change', '.input-product-product_id', function () {
        //     const rowId = '#' + $(this).attr('row-id'),
        //         price = $(this).children("option:selected").data('price');
        //     $(`${rowId} .input-product-price`).val(price);
        //     calculateTotal(rowId);
        // });


        // // Functions

        // //calculating the row total 
        // function calculateTotal(rowId) {
        //     const quantity = $(`${rowId} .input-product-quantity`).val(),
        //         price = $(`${rowId} .input-product-price`).val(),
        //         total = price * quantity;

        //     $(`${rowId} .input-product-total`).val(total);
        // }

    </script>
@endsection
