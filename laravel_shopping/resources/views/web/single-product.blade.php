@extends('layouts.web')
@section('title')
    <title>Single product</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('webs/comment/comment.css') }}">
@endsection
@section('content')
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @include('partials.web.content.single-sidebar')
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="">Category Name</a>
                            <a href="">{{ $singleProduct->name }}</a>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="{{ asset("$singleProduct->image_url") }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name">{{ $singleProduct->name }}</h2>
                                    <div class="product-inner-price">
                                        <ins>{{ $singleProduct->price }} $</ins>
                                        {{-- <del>$100.00</del> --}}
                                    </div>

                                    <form action="{{ route('add.cart.quantity', ['slug' => $singleProduct->slug]) }}"
                                        class="cart" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty"
                                                value="1" name="quantity" min="1" step="1">
                                        </div>
                                        <button class="add_to_cart_button" type="submit">Add to cart</button>
                                    </form>

                                    <div class="product-inner-category">
                                        <p>Category: <a href="">{{ $singleProduct->category->name }}</a>. Tags:
                                            @foreach ($singleProduct->tags as $tags)
                                                <a href="">
                                                    {{ $tags->name . ',' }}
                                                </a>
                                            @endforeach
                                        </p>
                                    </div>

                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home"
                                                    role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile"
                                                    role="tab" data-toggle="tab">Comment</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>
                                                {{ $singleProduct->description }}
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Comment</h2>
                                                <div class="submit-review">

                                                    @foreach ($comments as $comment)
                                                        <div class="comment">
                                                            <div class="col-md-12">
                                                                <div class="card p-6">
                                                                    <div class="justify-content-between align-items-center">
                                                                        <div class="user align-items-center">
                                                                            <img src="" width="30"
                                                                                class="user-img rounded-circle mr-2">
                                                                            <span><small
                                                                                    class="font-weight-bold text-primary">dsd</small>
                                                                                <small
                                                                                    class="font-weight-bold">{{ $comment->content }}</small></span>
                                                                        </div>
                                                                        <small>{{ $comment->create_at }}</small>
                                                                    </div>
                                                                    <div
                                                                        class="action  justify-content-between mt-2 align-items-center">
                                                                        <div class="reply px-4">
                                                                            <a
                                                                                href="{{ route('comment.delete', ['id' => $comment->id]) }}"><small>Remove</small></a>
                                                                            <span class="dots"></span>
                                                                            <small>Reply</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach

                                                    <form action="{{ route('comment.create') }}" method="post">
                                                        @csrf
                                                        @method('POST')
                                                        <p><label for="review">Your comment</label>
                                                            <textarea name="content" id="" cols="30" rows="10"></textarea>
                                                            <input type="text" name="productId"
                                                                value="{{ $singleProduct->id }}" hidden>
                                                        </p>

                                                        <p><input type="submit" value="Comment"></p>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Related Products</h2>

                            <div class="related-products-carousel">
                                @foreach ($relatedProducts as $relatedProduct)
                                    <div class="single-product">
                                        <div class="product-f-image">
                                            <img src="{{ asset("$relatedProduct->image_url") }}" alt="">
                                            <div class="product-hover">
                                                <a href="" class="add-to-cart-link"><i
                                                        class="fa fa-shopping-cart"></i> Add to cart</a>
                                                <a href="{{ route('single-product', ['slug' => $relatedProduct->slug]) }}"
                                                    class="view-details-link"><i class="fa fa-link"></i> See
                                                    details</a>
                                            </div>
                                        </div>


                                        <h2><a
                                                href="{{ route('single-product', ['slug' => $relatedProduct->slug]) }}">{{ $relatedProduct->name }}</a>
                                        </h2>

                                        <div class="product-carousel-price">
                                            <ins>{{ $relatedProduct->price }} $</ins>
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
    </div>
@endsection
