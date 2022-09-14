<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href="./"><img src="{{ asset('web/img/logo.png') }}"></a></h1>
                </div>
            </div>
            @php $totalCart = 0 @endphp
            @php $count = 0 @endphp
            @foreach ((array) session('cart') as $id => $cart)
                @php $totalCart += $cart['price'] * $cart['quantity'] @endphp
                @php $count++ @endphp
            @endforeach

            <div class="col-sm-6">
                <div class="shopping-item">
                    <a href="{{ route('cart') }}">Cart - <span class="cart-amunt">$ {{ $totalCart }}</span> <i
                            class="fa fa-shopping-cart"></i>
                        <span class="product-count">{{ $count }}</span></a>
                </div>
            </div>
            {{-- <div class="col-sm-2">
                <div class="shopping-item">
                    <a href="{{ route('cart') }}">Cart - <span class="cart-amunt">$ {{ $totalCart }}</span> <i
                            class="fa fa-shopping-cart"></i>
                        <span class="product-count">{{ $count }}</span></a>
                </div>
            </div> --}}

        </div>
    </div>
</div> <!-- End site branding area -->

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="shop.html">About</a></li>
                    <li><a href="{{ route('cart') }}">Cart</a></li>
                    <li><a href="{{ route('cart') }}">Checkout</a></li>
                    <li><a href="#">Others</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
