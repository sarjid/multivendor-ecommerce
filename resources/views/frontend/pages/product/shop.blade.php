@extends('frontend.layouts.master')
@section('content')
<style>
    .widget.price .range-price{
        font-size: 18px;
        border: none;
        background: #f8f8ff;
        width: 70%;
    }
</style>

    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Shop</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <section class="shop_grid_area section_padding_100">
        <div class="container">
        <form action="{{ route('shop.filter') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 col-sm-5 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- category filter -->
                        <div class="widget catagory mb-30">
                            <h6 class="widget-title">Product Categories</h6>
                            <div class="widget-desc">
                                <!-- Single Checkbox -->
                            @if (!empty($_GET['category']))
                                @php
                                    $filter_cats = explode(',',$_GET['category']);
                                @endphp
                            @endif
                            @forelse($cats as $cat)
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" @if(!empty($filter_cats) &&  in_array($cat->slug,$filter_cats)) checked @endif class="custom-control-input" id="{{ $cat->slug }}" name="category[]" onchange="this.form.submit();" value="{{ $cat->slug }}">
                                    <label class="custom-control-label" for="{{ $cat->slug }}">{{ $cat->title }} <span class="text-muted">({{ count($cat->products) }})</span></label>
                                </div>
                            @empty
                                <span class="text-danger">Category Not Found..!</span>
                            @endforelse
                            </div>
                        </div>

                        <!-- Filter Price -->
                        <div class="widget price mb-30">
                            <h6 class="widget-title">Filter by Price</h6>
                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div id="slider-range" data-min="{{ Helper::minPrice() }}" data-max="{{ Helper::maxPrice() }}" data-unit="" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="{{ Helper::minPrice() }}" data-value-max="{{ Helper::maxPrice() }}" data-label-result="Price:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>

                                    <input  type="hidden"  value="@if(!empty($_GET['price'])) {{ $_GET['price'] }} @endif" id="price_range" name="price_range">
                                    @if (!empty($_GET['price']))
                                        @php
                                        $price = explode('-',$_GET['price']);
                                        @endphp
                                    @endif
                                    <input type="text" class="range-price form-control" readonly id="amount" value="@if(!empty($_GET['price'])) ${{ $price[0] }} @else ${{ Helper::minPrice() }} @endif - @if(!empty($_GET['price'])) ${{ $price[1] }} @else ${{ Helper::maxPrice() }} @endif">

                                    {{-- <div class="range-price">Price: {{ Helper::minPrice() }} - {{ Helper::maxPrice() }}</div> --}}
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Filter</button>
                                </div>
                            </div>
                        </div>

                        <!-- color filter -->
                        {{-- <div class="widget color mb-30">
                            <h6 class="widget-title">Filter by Color</h6>
                            <div class="widget-desc">
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck6">
                                    <label class="custom-control-label black" for="customCheck6">Black <span class="text-muted">(9)</span></label>
                                </div>
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck7">
                                    <label class="custom-control-label pink" for="customCheck7">Pink <span class="text-muted">(6)</span></label>
                                </div>
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck8">
                                    <label class="custom-control-label red" for="customCheck8">Red <span class="text-muted">(8)</span></label>
                                </div>
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck9">
                                    <label class="custom-control-label purple" for="customCheck9">Purple <span class="text-muted">(4)</span></label>
                                </div>
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="customCheck10">
                                    <label class="custom-control-label orange" for="customCheck10">Orange <span class="text-muted">(7)</span></label>
                                </div>
                            </div>
                        </div> --}}

                        <!-- brands filter -->
                        <div class="widget brands mb-30">
                            <h6 class="widget-title">Filter by brands</h6>
                            <div class="widget-desc">
                            @if (!empty($_GET['brand']))
                                @php
                                    $filter_brands = explode(',',$_GET['brand']);
                                @endphp
                            @endif
                            @forelse ($brands as $brand)
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" @if(!empty($filter_brands) &&  in_array($brand->slug,$filter_brands)) checked @endif class="custom-control-input" id="{{ $brand->slug }}" value="{{ $brand->slug }}" name="brand[]" onchange="this.form.submit();">
                                    <label class="custom-control-label" for="{{ $brand->slug }}">{{ $brand->title }} <span class="text-muted">({{ count($brand->products) }})</span></label>
                                </div>
                            @empty
                                <span class="text-danger">No Brand Founds..!</span>
                            @endforelse
                            </div>
                        </div>

                        <!-- Single Widget -->
                        {{-- <div class="widget rating mb-30">
                            <h6 class="widget-title">Average Rating</h6>
                            <div class="widget-desc">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <span class="text-muted">(103)</span></a></li>

                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <span class="text-muted">(78)</span></a></li>

                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <span class="text-muted">(47)</span></a></li>

                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <span class="text-muted">(9)</span></a></li>

                                    <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <span class="text-muted">(3)</span></a></li>
                                </ul>
                            </div>
                        </div> --}}

                          <!-- size filter -->
                          <div class="widget brands mb-30">
                            <h6 class="widget-title">Filter by Size</h6>
                            <div class="widget-desc">
                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" @if(!empty($_GET['size']) && $_GET['size'] == 'S') checked @endif name="size" value="S"  onchange="this.form.submit();" class="custom-control-input" id="sizeS">
                                    <label class="custom-control-label" for="sizeS">S <span class="text-muted">({{ \App\Models\Product::where(['status' => 'active','size' => 'S'])->count() }})</span></label>
                                </div>

                                <!-- Single Checkbox -->
                                <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" @if(!empty($_GET['size']) && $_GET['size'] == 'M') checked @endif name="size" value="M"  onchange="this.form.submit();" class="custom-control-input" id="sizeM">
                                    <label class="custom-control-label" for="sizeM">M <span class="text-muted">({{ \App\Models\Product::where(['status' => 'active','size' => 'M'])->count() }})</span></label>
                                </div>

                                 <!-- Single Checkbox -->
                                 <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" @if(!empty($_GET['size']) && $_GET['size'] == 'L') checked @endif name="size" value="L"  onchange="this.form.submit();" class="custom-control-input" id="sizeL">
                                    <label class="custom-control-label" for="sizeL">L <span class="text-muted">({{ \App\Models\Product::where(['status' => 'active','size' => 'L'])->count() }})</span></label>
                                </div>

                                 <!-- Single Checkbox -->
                                 <div class="custom-control custom-checkbox d-flex align-items-center mb-2">
                                    <input type="checkbox" @if(!empty($_GET['size']) && $_GET['size'] == 'XL') checked @endif name="size" value="XL"  onchange="this.form.submit();" class="custom-control-input" id="sizeXL">
                                    <label class="custom-control-label" for="sizeXL">XL <span class="text-muted">({{ \App\Models\Product::where(['status' => 'active','size' => 'XL'])->count() }})</span></label>
                                </div>

                            </div>
                        </div>
                        <!-- Single Widget -->
                        {{-- <div class="widget size mb-30">
                            <h6 class="widget-title">Filter by Size</h6>
                            <div class="widget-desc">
                                <ul>
                                    <li><a href="#">XS</a></li>
                                    <li><a href="#">S</a></li>
                                    <li><a href="#">M</a></li>
                                    <li><a href="#">L</a></li>
                                    <li><a href="#">XL</a></li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-12 col-sm-7 col-md-8 col-lg-9">
                    <!-- Shop Top Sidebar -->
                    <div class="shop_top_sidebar_area d-flex flex-wrap align-items-center justify-content-between">
                        <div class="view_area d-flex">
                            <div class="grid_view">
                                <a href="shop-grid-left-sidebar.html" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="icofont-layout"></i></a>
                            </div>
                            <div class="list_view ml-3">
                                <a href="shop-list-left-sidebar.html" data-toggle="tooltip" data-placement="top" title="List View"><i class="icofont-listine-dots"></i></a>
                            </div>
                        </div>
                        <select class="small right" name="sortBy" onchange="this.form.submit();">
                            <option selected value="">Sort By Default</option>
                            <option value="priceAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='priceAsc') selected @endif >Price - Lower To Higher</option>
                            <option value="priceDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='priceDesc') selected @endif>Price - Higher To Lower</option>
                            <option value="titleAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='titleAsc') selected @endif>Alphabetical Ascending</option>
                            <option value="titleDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='titleDesc') selected @endif>Alphabetical Descending</option>
                            <option value="disAsc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='disAsc') selected @endif>Discount - Lower To Higher</option>
                            <option value="disDesc" @if(!empty($_GET['sortBy']) && $_GET['sortBy']=='disDesc') selected @endif>Discount - Higher To Lower</option>
                        </select>
                    </div>

                    <h6>Total Products: {{ $products->total() }}</h6>
                    <div class="shop_grid_product_area">
                        <div class="row justify-content-center">
                        @if (count($products) >0)
                            @foreach ($products as $item)
                            <!-- Single Product -->
                            <div class="col-9 col-sm-12 col-md-6 col-lg-4">
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

                                        <!-- Compare -->
                                        {{-- <div class="product_compare">
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
                                            {{ Helper::currency_converter($item->price) }}
                                         @else
                                           {{ Helper::currency_converter($item->offer_price) }}
                                           <small><del class="text-danger">{{ Helper::currency_converter($item->price) }}</del></small>
                                         @endif
                                        </h6>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <strong class="text-danger">No Product Found..!</strong>
                        @endif
                        </div>
                    </div>
                    {{ $products->appends($_GET)->links('vendor.pagination.custom') }}
                    <!-- Shop Pagination Area -->
                </div>
            </div>
        </form>
        </div>
    </section>
@endsection

@section('scripts')
    {{-- -------- price slider -------------  --}}
    <script>
        $(document).ready(function () {
            if ($('#slider-range').length >0) {
                const max_value = parseInt($('#slider-range').data('max'));
                const min_value = parseInt($('#slider-range').data('min'));
                // const currency = $('#slider-range').data('unit') || '';
                let price_range = min_value+'-'+max_value;
                if ($('#price_range').length >0 && $('#price_range').val()) {
                    price_range = $('#price_range').val().trim();
                }

                let price = price_range.split('-');
                $('#slider-range').slider({
                    range:true,
                    min:min_value,
                    max:max_value,
                    values:price,
                    slide:function(event,ui){
                        $('#amount').val('$'+ui.values[0]+"-"+'$'+ui.values[1]);
                        $('#price_range').val(ui.values[0]+"-"+ui.values[1]);
                    }
                })

            }
        });
    </script>

    {{-- //product add to cart  --}}
    <script>
        $(document).on('click','.add_to_cart',function (e) {
            e.preventDefault();
            var product_id = $(this).data('product-id');
            var product_qty = $(this).data('quantity');

            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.store') }}";

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    product_id:product_id,
                    product_qty:product_qty,
                    _token:token
                },

                beforeSend:function(){
                    $('#add_to_cart'+product_id).html('<i class="fa fa-spinner fa-spin"></i> Loading...')
                },
                complete: function (response) {
                    $('#add_to_cart'+product_id).html('<i class="fa fa-cart-plus"></i> Add to Cart')
                },
                success:function(data){
                    if (data['status']) {
                        //for mini cart
                        $('body #header-ajax').html(data['header']);
                        //start alert
                        swal({
                        title: "",
                        text: data['message'],
                        icon: "success",
                        button: false,
                        timer: 1500,
                        });
                        //end alert
                    }
                }
            });
        });
    </script>
     {{-- //Cart delete  --}}
     <script>
        $(document).on('click','.cart_delete',function (e) {
            e.preventDefault();
            var cart_id = $(this).data('id');
            var product_qty = $(this).data('quantity');

            var token = "{{ csrf_token() }}";
            var path = "{{ route('cart.delete') }}";

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    cart_id:cart_id,
                    _token:token
                },

                success:function(data){
                    if (data['status']) {
                        //for mini cart
                        $('body #header-ajax').html(data['header']);
                        //start alert
                        swal({
                        title: "",
                        text: data['message'],
                        icon: "success",
                        button: false,
                        timer: 1500,
                        });
                        //end alert
                    }
                },

                error:function(err){
                    console.log(err)
                }
            });
        });
    </script>
 {{-- //product add to wishlist  --}}
    <script>
        $(document).on('click','.add_to_wishlist',function (e) {
            e.preventDefault();
            var product_id = $(this).data('id');
            var product_qty = $(this).data('qty');

            var token = "{{ csrf_token() }}";
            var path = "{{ route('wishlist.store') }}";

            $.ajax({
                url: path,
                type: "POST",
                dataType: "JSON",
                data: {
                    product_id:product_id,
                    product_qty:product_qty,
                    _token:token
                },

                beforeSend:function(){
                    $('#add_to_wishlist_'+product_id).html('<i class="fa fa-spinner fa-spin"></i>')
                },
                complete: function (response) {
                    $('#add_to_wishlist_'+product_id).html('<i class="fa fa-heart"></i>')
                },
                success:function(data){
                    if (data['status']) {
                        //for mini cart
                        $('body #header-ajax').html(data['header']);
                        $('body #wishlist_counter').html(data['wishlist_count']);
                        //start alert
                        swal({
                        title: "",
                        text: data['message'],
                        icon: "success",
                        button: false,
                        timer: 1500,
                        });
                        //end alert
                    }else{
                        //start alert
                        swal({
                        title: "",
                        text: data['message_error'],
                        icon: "error",
                        button: false,
                        timer: 1500,
                        });
                        //end alert
                    }
                }
            });
        });
    </script>
@endsection
