@extends('layouts.web')
@section('title')
    <title>Home</title>
@endsection
@section('content')
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="product-carousel">
                            @foreach ($products as $item)
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="{{ asset("$item->image_url") }}" height="400px" width="100px">
                                        <div class="product-hover">
                                            <a href="{{ route('add.cart', ['slug' => $item->slug]) }}"
                                                class="add-to-cart-link"><i class="fa fa-shopping-cart"></i>
                                                Add to cart</a>
                                            <a href="{{ route('single-product', ['slug' => $item->slug]) }}"
                                                class="view-details-link"><i class="fa fa-link"></i>
                                                See details</a>
                                        </div>
                                    </div>

                                    <h2><a
                                            href="{{ route('single-product', ['slug' => $item->slug]) }}">{{ $item->name }}</a>
                                    </h2>

                                    <div class="product-carousel-price">
                                        <ins>{{ $item->price }}</ins>
                                        {{-- <del>$100.00</del> --}}
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="brands-area">
        <div class="zigzag-bottom">
        </div>
        <div class="container">
            <h2 class="section-title" style="color: black">All Category</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            @foreach ($categories as $item)
                                <a href="">{{ $item->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top Sellers</h2>
                        <a href="" class="wid-view-more">View All</a>
                        <div class="single-wid-product">
                           
                            <h2><a href="single-product.html">Sony Smart TV - 2015</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Recently Viewed</h2>
                        <a href="#" class="wid-view-more">View All</a>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/product-thumb-4.jpg" alt=""
                                    class="product-thumb"></a>
                            <h2><a href="single-product.html">Sony playstation microsoft</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top New</h2>
                        <a href="#" class="wid-view-more">View All</a>
                        <div class="single-wid-product">
                            <a href="single-product.html"><img src="img/product-thumb-3.jpg" alt=""
                                    class="product-thumb"></a>
                            <h2><a href="single-product.html">Apple new i phone 6</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$400.00</ins> <del>$425.00</del>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- modal show message --}}
    <div class="modal fade" id="notification" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="notification" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notification">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="">
                    @csrf
                    <div class="modal-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @if (!empty(Session::get('message')) && Session::get('message'))
        <script>
            $(function() {
                $('#notification').modal('show');
            });
        </script>
    @endif
@endsection
