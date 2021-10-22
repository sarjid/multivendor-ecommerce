@extends('frontend.layouts.master')
@section('content')
 <!-- Breadcumb Area -->
 <div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>{{ $product->title }}</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">{{ $product->title }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Single Product Details Area -->
<section class="single_product_details_area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                        <!-- Carousel Inner -->
                        <div class="carousel-inner">
                        @foreach ($photos as $key=>$photo)
                            <div class="carousel-item {{ $key == 0 ? 'active':'' }}">
                                <a class="gallery_img" href="{{ $photo }}" title="First Slide">
                                    <img class="d-block w-100" src="{{ $photo }}" alt="First slide">
                                </a>
                                <!-- Product Badge -->
                                <div class="product_badge">
                                    <span class="badge-new">{{ $product->conditions }}</span>
                                </div>
                            </div>
                        @endforeach

                        </div>

                        <!-- Carosel Indicators -->
                        <ol class="carousel-indicators">
                        @foreach ($photos as $key=>$photo)
                            <li class="{{ $key == 0 ? 'active' : '' }}" data-target="#product_details_slider" data-slide-to="{{ $key }}" style="background-image: url({{ $photo }});">
                            </li>
                        @endforeach
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Single Product Description -->
            <div class="col-12 col-lg-6">
                <div class="single_product_desc">
                    <h4 class="title mb-2">{{ $product->title }}</h4>
                    <div class="single_product_ratings mb-2">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class="text-muted">({{ count($productReviews) }} Reviews)</span>
                    </div>
                    <h4 class="price mb-4">
                        @if ($product->offer_price == 0)
                            {{ Helper::currency_converter($product->price) }}
                        @else
                            {{ Helper::currency_converter($product->offer_price) }}
                            <span>{{ Helper::currency_converter($product->price) }}</span>
                    </h4>
                        @endif
                    <!-- Overview -->
                    <div class="short_overview mb-4">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum dolores natus laboriosam accusantium, suscipit saepe eum deleniti mollitia at, odio, facere nisi aspernatur doloribus aperiam atque deserunt minima vitae rerum laudantium. Sapiente distinctio ipsam vitae dolorum odit, suscipit, aliquid.</p>
                    </div>

                    <!-- Color Option -->
                    <div class="widget p-0 color mb-3">
                        <h6 class="widget-title">Color</h6>
                        <div class="widget-desc d-flex">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label black" for="customRadio1"></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label pink" for="customRadio2"></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label red" for="customRadio3"></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label purple" for="customRadio4"></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label white" for="customRadio5"></label>
                            </div>
                        </div>
                    </div>

                    <!-- Size Option -->
                    <div class="widget p-0 size mb-3">
                        <h6 class="widget-title">Size</h6>
                        <div class="widget-desc">
                            <ul>
                                <div class="form-group">
                                  <label for="size"></label>
                                  <select  name="size" id="size">
                                    @foreach ($productAttributes as $size)
                                        <option value="{{ $size->size }}">{{ $size->size }}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </ul>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <form class="cart clearfix my-5 d-flex flex-wrap align-items-center" method="post">
                        <div class="quantity">
                            <input type="number" class="qty-text form-control" id="qty2" step="1" min="1" max="12" name="quantity" value="1">
                        </div>
                        <button type="submit" name="addtocart" value="5" class="btn btn-primary mt-1 mt-md-0 ml-1 ml-md-3">Add to cart</button>
                    </form>

                    <!-- Others Info -->
                    <div class="others_info_area mb-3 d-flex flex-wrap">
                        <a class="add_to_wishlist" href="wishlist.html"><i class="fa fa-heart" aria-hidden="true"></i> WISHLIST</a>
                        <a class="add_to_compare" href="compare.html"><i class="fa fa-th" aria-hidden="true"></i> COMPARE</a>
                        <a class="share_with_friend" href="#"><i class="fa fa-share" aria-hidden="true"></i> SHARE WITH FRIEND</a>
                    </div>

                    <!-- Size Guide -->
                    <div class="sizeguide">
                        <h6>Size Guide</h6>
                        @php
                            $sizeGuide = explode(',',$product->size_guide);
                        @endphp
                        <div class="size_guide_thumb d-flex">
                            @if ($sizeGuide == '')
                                <a class="size_guide_img" href="{{ $product->size_guide }}" style="background-image: url({{ $product->size_guide }});">
                                </a>
                            @else
                                @foreach ($sizeGuide as $guide)
                                <a class="size_guide_img" href="{{ $guide }}" style="background-image: url({{ $guide }});">
                                </a>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_details_tab section_padding_100_0 clearfix">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="product-details-tab">
                        <li class="nav-item">
                            <a href="#description" class="nav-link active" data-toggle="tab" role="tab">Description</a>
                        </li>
                        <li class="nav-item">
                            <a href="#reviews" class="nav-link" data-toggle="tab" role="tab">Reviews <span class="text-muted">({{ count($productReviews) }})</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="#addi-info" class="nav-link" data-toggle="tab" role="tab">Additional Information</a>
                        </li>
                        <li class="nav-item">
                            <a href="#refund" class="nav-link" data-toggle="tab" role="tab">Return &amp; Cancellation</a>
                        </li>
                    </ul>
                    <!-- Tab Content -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="description">
                            <div class="description_area">
                                <h5>Description</h5>
                                <p>{!! $product->description !!}</p>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="reviews">
                            <div class="reviews_area">
                                <ul>
                                    <li>
                                    @foreach ($productReviews as $review)
                                        <div class="single_user_review mb-15">
                                            <div class="review-rating">
                                            @for ($i=0; $i<5; $i++)
                                                @if ($review->rate > $i)
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                                <span> for {{ $review->reason }}</span>
                                            </div>
                                            <div class="review-details">
                                                <p>by <a href="#">{{ $review->user->full_name }}</a> on <span>{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y') }}</span></p>
                                            </div>
                                            <p>{{ $review->review }}</p>
                                        </div>
                                    @endforeach
                                    {{ $productReviews->links('vendor.pagination.custom') }}
                                    </li>
                                </ul>
                            </div>

                            <div class="submit_a_review_area mt-50">
                                <form action="{{ route('productreview.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="form-group">
                                        <span>Your Ratings</span>
                                        <div class="stars">
                                            <input type="radio" name="rate" class="star-1" id="star-1" value="1">
                                            <label class="star-1" for="star-1">1</label>
                                            <input type="radio" name="rate" class="star-2" id="star-2" value="2">
                                            <label class="star-2" for="star-2">2</label>
                                            <input type="radio" name="rate" class="star-3" id="star-3" value="3">
                                            <label class="star-3" for="star-3">3</label>
                                            <input type="radio" name="rate" class="star-4" id="star-4" value="4">
                                            <label class="star-4" for="star-4">4</label>
                                            <input type="radio" name="rate" class="star-5" id="star-5" value="5">
                                            <label class="star-5" for="star-5">5</label>
                                            <span></span>
                                        </div>
                                        @error('rate')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="options">Reason for your rating</label>
                                        <select class="form-control small right py-0 w-100" id="options" name="reason">
                                            <option value="quality">Quality</option>
                                            <option value="value">Value</option>
                                            <option value="design">Design</option>
                                            <option value="price">Price</option>
                                            <option value="others">Others</option>
                                        </select>
                                    @error('reason')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="comments">Comments</label>
                                        <textarea class="form-control" id="comments" rows="5" data-max-length="150" name="review"></textarea>
                                        @error('review')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </form>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="addi-info">
                            <div class="additional_info_area">
                                <h5>Additional Info</h5>
                                <p>{!! $product->additional_info !!}</p>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="refund">
                            <div class="refund_area">
                                <h6>Return Policy</h6>
                                <p>{!! $product->return_cancellation !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Single Product Details Area End -->

 <!-- Related Products Area -->
 <section class="you_may_like_area section_padding_0_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_heading new_arrivals">
                    <h5>You May Also Like</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="you_make_like_slider owl-carousel">
            @if ($product->rel_prods->isEmpty())
                <strong class="text-danger">Product Not Found</strong>

            @else    <!-- Single Product -->
                @foreach ($product->rel_prods as $item)
                    @if ($item->id != $product->id)
                        <div class="single-product-area">
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
                                    <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                </div>

                                <!-- Compare -->
                                <div class="product_compare">
                                    <a href="compare.html"><i class="icofont-exchange"></i></a>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="product_description">
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#" ><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                </div>

                                <!-- Quick View -->
                                <div class="product_quick_view">
                                    <a href="#" data-toggle="modal" data-target="#quickview"><i class="icofont-eye-alt"></i> Quick View</a>
                                </div>

                                <p class="brand_name">
                                    {{ App\Models\Brand::where('id',$item->brand_id)->value('title') }}
                                </p>
                                <a href="{{ route('product.detail',$item->slug) }}">{{ $item->title }}</a>
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
                    @endif
                @endforeach
            @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related Products Area -->
@endsection
