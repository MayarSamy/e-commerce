@extends('layouts.app')

@section('offers')
<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker">
                        <ul class="offer-box">
                            @foreach ($products as $product)
                            @if ($product->offer)
                            <li>
                                <i class="fab fa-opencart"></i>{{$product->offer}}
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="custom-select-box">
                    <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                        <option>¥ JPY</option>
                        <option>$ USD</option>
                        <option>€ EUR</option>
                    </select>
                </div>
                <div class="our-link">
                    <ul>
                        <li>
                            <form action="{{route('logout')}}" method="POST" class="nav-link text-center">
                                @csrf
                                <button type="submit" class="btn btn-link"> Logout</button>
                            </form>
                        </li>
                        <li><a href="#">Our location</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="products-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>Featured Products</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                </div>
            </div>
        </div>

        <div class="row special-list">
            @foreach ($products as $product)
            <div class="col-lg-3 col-md-6 special-grid best-seller">
                <div class="products-single fix">
                    <div class="box-img-hover">
                        @if($product->name == 'Shoes')
                        <div class="type-lb">
                            <p class="sale">Sale</p>
                        </div>
                        @endif
                        <img src="{{asset('/website-style/images/' .$product->image)}}" class="img-fluid" alt="Image">
                        <div class="mask-icon">
                            <ul>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                            </ul>
                            <a class="cart" href="{{ url('add/'.$product->id) }}">Add one to Cart</a>
                        </div>
                    </div>
                    <div class="why-text">
                        <h4>{{$product->name}}</h4>
                        @if($product->name == 'Shoes')
                            <h4 style="text-decoration: line-through">${{$product->price}}</h4>
                            <h5>{{$product->price - ($product->price * 0.10)}}</h6>
                        @else
                            <h5>${{$product->price}}</h5>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
