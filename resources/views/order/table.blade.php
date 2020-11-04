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
                            <?php $subTotal = session()->get('sub-total') ?>
                            @if(session('orders'))
                            @foreach(session('orders') as $id => $details)
                            <tr>
                                <td class="name-pr">
                                    <a href="#">
                                        {{ $details['name'] }}
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
                                    <button class="btn btn-danger btn-sm remove" data-id="{{ $id }}"><i class="fa fa-trash-o"></i>Remove</button>
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
                        <div class="ml-auto"> {{ $subTotal }} </div>
                    </div>
                    <div class="d-flex">
                        <h4>Tax</h4>
                        <div class="ml-auto"> {{ $subTotal * 0.14}} </div>
                    </div>
                    <div class="d-flex">
                        <h4>Discount</h4>
                    </div>
                    @foreach(session('orders') as $id => $details)
                    @if($details['offer'] != null)
                    <div class="d-flex">
                        <h4></h4>
                        <div class="ml-auto"> {{$details['offer']}} </div>
                    </div>
                    @endif
                    @endforeach

                    <hr class="my-1">
                    <div class="d-flex gr-total">
                        <h5>Grand Total</h5>
                        <div class="ml-auto h5">{{ ($subTotal * 0.14) + $subTotal}}</div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="col-12 d-flex shopping-box"><a href="{{route('orders.store')}}" class="ml-auto btn hvr-hover">Checkout</a> </div>
        </div>
    </div>
</div>

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
</script>
@endsection