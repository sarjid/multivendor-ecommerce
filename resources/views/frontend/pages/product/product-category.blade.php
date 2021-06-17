@extends('frontend.layouts.master')
@section('content')
        <!-- Breadcumb Area -->
        <div class="breadcumb_area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <h5>{{ $categories->title }}</h5>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active">{{ $categories->title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcumb Area -->

        <section class="shop_grid_area section_padding_100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
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
                            <select class="small right" id="sortBy">
                                <option selected>Sort By Products</option>
                                <option value="priceAsc" {{ ( $sort == 'priceAsc') ? 'selected':'' }}>Price - Lower To Higher</option>
                                <option value="priceDesc" {{ ( $sort == 'priceDesc') ? 'selected':'' }}>Price - Higher To Lower</option>
                                <option value="titleAsc" {{ ( $sort == 'titleAsc') ? 'selected':'' }}>Alphabetical Ascending</option>
                                <option value="titleDesc" {{ ( $sort == 'titleDesc') ? 'selected':'' }}>Alphabetical Descending</option>
                                <option value="disAsc" {{ ( $sort == 'disAsc') ? 'selected':'' }}>Discount - Lower To Higher</option>
                                <option value="disDesc" {{ ( $sort == 'disDesc') ? 'selected':'' }}>Discount - Higher To Lower</option>
                            </select>
                        </div>

                        <div class="shop_grid_product_area">
                            <div class="row justify-content-center" id="product-data">
                            {{-- ------ single product start ------ --}}
                            @include('frontend.layouts.single-product')
                            {{-- ------ single product end ------ --}}
                            </div>
                        </div>
                        {{-- // ajax loader gif --}}
                        <div class="ajax-load text-center" style="display: none;">
                            <img src="{{ asset('frontend/img/ajaxloader.gif') }}" alt="" style="display: block;
                            margin-left: auto;
                            margin-right: auto;
                            width: 7%;">
                        </div>
                        {{-- <h6 class="text-danger text-center" id="noData">No More Data </h6> --}}
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')
{{-- //sortby product code  --}}
    <script>
        $('#sortBy').change(function () {
           var sort = $('#sortBy').val();
           window.location = "{{ url(''.$route.'') }}/{{ $categories->slug }}?sort="+sort;
        });
    </script>
{{-- //ajax load more data code  --}}
    <script>
        function loadmoreData(page){
            $.ajax({
                url: "?page="+page,
                type: "get",
                beforeSend:function(){
                    $('.ajax-load').show();
                }
            })

            .done(function(data){
                if (data.html == '') {
                    $('.ajax-load').html('No More Data Found');
                    return;
                }
                $('.ajax-load').hide();
                $('#product-data').append(data.html);
            })

            .fail(function(){
               alert('something went wrong');
            });
        }

        var page = 1;
        $(window).scroll(function () {
            if ($(window).scrollTop() +$(window).height()+120 >= $(document).height()) {
                page ++;
                loadmoreData(page);
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
