<div class="col-md-4">
    <div class="single-sidebar">
        <h2 class="sidebar-title">Search Products</h2>
        <form action="">
            <input type="text" placeholder="Search products...">
            <input type="submit" value="Search">
        </form>
    </div>

    <div class="c">
        <h2 class="sidebar-title">new Products</h2>
        <div class="thubmnail-recent">
            @foreach ($newProducts as $newProduct)
             
                    <img src="{{ asset("$newProduct->image_url") }}" class="recent-thumb" alt="">
                    <h2><a
                            href="{{ route('single-product', ['slug' => $newProduct->slug]) }}">{{ $newProduct->name }}</a>
                    </h2>
                    <div class="product-sidebar-price">
                        <ins>{{ $newProduct->price }} $</ins>
                        {{-- <del>$100.00</del> --}}
                    </div>
               
            @endforeach
        </div>
    </div>

    {{-- <div class="single-sidebar">
        <h2 class="sidebar-title">Recent Posts</h2>
        <ul>
            <li><a href="">Sony Smart TV - 2015</a></li>
            <li><a href="">Sony Smart TV - 2015</a></li>
            <li><a href="">Sony Smart TV - 2015</a></li>
            <li><a href="">Sony Smart TV - 2015</a></li>
            <li><a href="">Sony Smart TV - 2015</a></li>
        </ul>
    </div> --}}
</div>
