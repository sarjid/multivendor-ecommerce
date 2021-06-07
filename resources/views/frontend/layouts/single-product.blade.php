{{-- @if ($products->isEmpty())
<strong class="text-danger">Product Not Found</strong>
@else --}}
<!-- Single Product -->
@foreach ($products as $item)
<div class="col-9 col-sm-6 col-md-4 col-lg-3">
    <div class="single-product-area mb-30">
        <div class="product_image">
            @php
                $photo = explode(',',$item->photo);
            @endphp
            <!-- Product Image -->
            @if (count($photo) == 1)
                <img class="normal_img" src="{{ $item->photo }}" alt="">
                <img class="hover_img" src="{{ $item->photo }}" alt="">
            @else
                <img class="normal_img" src="{{ $photo[0] }}" alt="">
                <img class="hover_img" src="{{ $photo[1] }}" alt="">
            @endif

            <!-- Product Badge -->
            <div class="product_badge">
                <span>{{ $item->conditions }}</span>
            </div>

            <!-- Wishlist -->
            <div class="product_wishlist">
                <a href="#" class="add_to_wishlist" id="add_to_wishlist_{{ $item->id }}" data-qty="1" data-id="{{ $item->id }}"><i class="icofont-heart"></i></a>
            </div>

            {{-- <!-- Compare -->
            <div class="product_compare">
                <a href="compare.html"><i class="icofont-exchange"></i></a>
            </div> --}}
        </div>

        <!-- Product Description -->
        <div class="product_description">
            <!-- Add to cart -->
            <div class="product_add_to_cart">
                <a href="javascript::void(0)" data-quantity="1" data-product-id="{{ $item->id }}" class="add_to_cart" id="add_to_cart{{ $item->id }}"><i class="icofont-shopping-cart"></i> Add to Cart</a>
            </div>

            <!-- Quick View -->
            <div class="product_quick_view">
                <a href="#" data-toggle="modal" data-target="#quickview"><i class="icofont-eye-alt"></i> Quick View</a>
            </div>

            <p class="brand_name">
                {{ App\Models\Brand::where('id',$item->brand_id)->value('title') }}
            </p>
            <a href="{{ route('product.detail',$item->slug) }}">{{ ucfirst($item->title) }}</a>
            <h6 class="product-price">
              @if ($item->offer_price == 0)
                 ${{ number_format($item->price,2) }}
              @else
                ${{ number_format($item->offer_price,2) }}
                <small><del class="text-danger">{{ number_format($item->price,2) }}</del></small>
              @endif
            </h6>
        </div>
    </div>

</div>
@endforeach
{{-- @endif --}}
<!-- Single Product end -->
