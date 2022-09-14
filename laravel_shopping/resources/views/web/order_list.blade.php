@extends('layouts.web')
@section('title')
    <title>Order Product</title>
@endsection
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Order Product</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                @include('partials.web.content.single-sidebar')
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalCart = 0 @endphp
                                    @foreach ((array) session('cart') as $id => $cart)
                                        @php $totalCart += $cart['price'] * $cart['quantity'] @endphp
                                    @endforeach

                                    @if (session('cart'))
                                        @foreach (session('cart') as $cart)
                                            @php $total = 0 @endphp
                                            @php $total += $cart['price'] * $cart['quantity'] @endphp
                                            <tr class="cart_item" data-id="{{ $cart['name'] }}">

                                                <td class="product-remove">
                                                    <a title="Remove this item" class="remove"
                                                        href="{{ route('remove.cart', ['slug' => $cart['slug']]) }}"><i
                                                            class="fa fa-trash-o data-id"></i></a>
                                                </td>

                                                <td class="product-thumbnail">
                                                    <a href=""><img width="145" height="145" alt="poster_1_up"
                                                            class="shop_thumbnail" src="{{ asset($cart['image']) }}"></a>
                                                </td>

                                                <td class="product-name">
                                                    <a href="single-product.html">{{ $cart['name'] }}</a>
                                                </td>

                                                <td class="product-price">
                                                    <span class="amount">$ {{ $cart['price'] }}</span>
                                                </td>

                                                <td data-th="quantity">
                                                    <form action="{{ route('update.cart', ['slug' => $cart['slug']]) }}"
                                                        method="post">
                                                        @method('PATCH')
                                                        @csrf
                                                        <input type="hidden" name="slug" value={{ $cart['slug'] }}>
                                                        <input type="number" value="{{ $cart['quantity'] }}"
                                                            name="quantity" class="form-control" />
                                                        <button type="submit"class="btn btn-success">Update</button>
                                                    </form>

                                                </td>

                                                <td class="product-subtotal">
                                                    <span class="amount">$ {{ $total }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif                                   
                                </tbody>
                            </table>                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

