
<!-- Hero Meta -->
    <!-- Search -->
    <div class="search-area">
        <div class="search-btn"><i class="icofont-search"></i></div>
        <!-- Form -->
        <form action="{{ route('search') }}" method="GET">
            <div class="search-form d-flex">
                <input type="search" id="search_text" name="query" class="form-control" placeholder="Search">
                {{-- <input type="submit" class="d-none" value="Send"> --}}
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>

    <!-- Wishlist -->
    <div class="wishlist-area">
        <a href="{{ route('wishlist') }}" id="wishlist_counter"  class="wishlist-btn"><i class="icofont-heart"></i><span class="cart_quantity">{{ \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->count() }}</span>
        </a>
    </div>

    <!-- Cart -->
    <div class="cart-area">
        <div class="cart--btn"><i class="icofont-cart"></i> <span class="cart_quantity">{{ \Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->count() }}</span></div>

        <!-- Cart Dropdown Content -->
        <div class="cart-dropdown-content" style="height: 500px; overflow: auto;">
            <ul class="cart-list">
            @foreach (\Gloudemans\Shoppingcart\Facades\Cart::instance('shopping')->content() as $item)
                <li>
                    <div class="cart-item-desc">
                        <a href="{{ route('product.detail',$item->model->slug) }}" class="image">
                        @php
                            $photo = explode(',',$item->model->photo);
                        @endphp
                            @if (count($photo) ==1)
                                <img src="{{ $item->model->photo }}" class="cart-thumb" alt="Product Image">
                            @else
                                <img src="{{ $photo[0] }}" class="cart-thumb" alt="Product Image">
                            @endif
                        </a>
                        <div>
                            <a href="{{ route('product.detail',$item->model->slug) }}">
                                {{ $item->name }}
                            </a>
                            <p>{{ $item->qty }} x - <span class="price">${{ number_format($item->price,2) }}</span></p>
                        </div>
                    </div>
                    <span class="dropdown-product-remove cart_delete" data-id="{{ $item->rowId }}"><i class="icofont-bin"></i></span>
                </li>
            @endforeach
            </ul>
            <div class="cart-pricing my-4">
                <ul>
                    <li>
                        <span>Sub Total:</span>
                        <span>${{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</span>
                    </li>
                    <li>
                        <span>Total:</span>
                        @if (session()->has('coupon'))

                            {{-- <span>${{ filter_var( \Gloudemans\Shoppingcart\Facades\Cart::subtotal(),FILTER_SANITIZE_NUMBER_INT) - session('coupon')['value'] }}</span> --}}
                            @php
                              $subtotal =  str_replace(',','',\Gloudemans\Shoppingcart\Facades\Cart::subtotal());

                              $sessionSubtotal =  str_replace(',','',session('coupon')['value']);
                            @endphp

                            ${{ number_format(round($subtotal-$sessionSubtotal),2) }}
                        @else
                            <span>${{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal() }}</span>
                        @endif

                    </li>
                </ul>
            </div>
            <div class="cart-box">
                <a href="{{ route('cart') }}" class="btn btn-sm btn-primary d-block">Cart</a>
                <a href="{{ route("checkout1") }}" class="btn btn-sm btn-primary d-block mt-1">Checkout</a>
            </div>
        </div>
    </div>

    <!-- Account -->
    <div class="account-area">
        <div class="user-thumbnail">
        @auth
                @if (auth()->user()->photo)
                    <img src="{{ auth()->user()->photo }}" alt="">
                @else
                    <img src="{{ Helper::userDefaultImage() }}" alt="">
                @endif
            @else
            <img src="{{ Helper::userDefaultImage() }}" alt="">
        @endauth
        </div>
        <ul class="user-meta-dropdown">
        @auth
            @php
                $firstName = explode(' ',auth()->user()->full_name)
            @endphp
            <li class="user-title"><span>Hello,</span> {{ $firstName[0] }} !</li>
            <li><a href="{{ route('user.dashboard') }}">My Account</a></li>
            <li><a href="{{ route('user.order') }}">Orders List</a></li>
            <li><a href="wishlist.html">Wishlist</a></li>
            <li><a href="{{ route('user.logout') }}"><i class="icofont-logout"></i> Logout</a></li>
        @else
            <li><a href="{{ route('user.auth') }}">Login & Register</a></li>
        @endauth
        </ul>
    </div>
