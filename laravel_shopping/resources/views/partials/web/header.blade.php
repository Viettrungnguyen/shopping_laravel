<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul>
                        @if (Auth::user())
                            <li><a href="{{ route('profile') }}"><i class="fa fa-user"></i> My Account</a></li>
                        @endif
                        <li><a href="{{ route('myOrder') }}"><i class="fa fa-heart"></i> My order</a></li>
                        <li><a href="{{ route('cart') }}"><i class="fa fa-user"></i> My Cart</a></li>
                        <li><a href="checkout.html"><i class="fa fa-user"></i> Checkout</a></li>
                        @if (!Auth::user())
                            <li><a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a></li>
                        @endif
                        @if (Auth::user())
                            <li><a href="{{ route('logout') }}"><i class="fa fa-user"></i> Logout</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="header-right">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small">
                            @if (Auth::user())
                                @php $countNotification = 0 @endphp
                            @foreach ((array) $notifications as $id => $notification)
                                @php $countNotification++ @endphp
                            @endforeach
                            @endif
                        
                            <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span
                                    class="key">Notification :</span><span class="value">
                                    @if (Auth::user())
                                        {{ $countNotification }}
                                        @endif @if (!Auth::user())
                                            0
                                        @endif
                                </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                @if (Auth::user())
                                    @foreach ($notifications as $notification)
                                        <li><a href="#">{{ $notification->title }}</a>
                                        </li>
                                    @endforeach
                                @endif

                                {{-- <li><a href="{{ route('order.list') }}">English</a></li>
                                <li><a href="#">French</a></li>
                                <li><a href="#">German</a></li> --}}
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
