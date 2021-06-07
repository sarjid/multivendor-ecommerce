@extends('frontend.layouts.master')
@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Wishlist</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Wishlist Table Area -->
    <div class="wishlist-table section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table wishlist-table">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-30">
                                <thead>
                                    <tr>
                                        <th scope="col"><i class="icofont-ui-delete"></i></th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="wishlist_page">
                                    @include('frontend.layouts._wishlist')
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="cart-footer text-right">
                        <div class="back-to-shop">
                            <a href="#" class="btn btn-primary">Add All Item</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wishlist Table Area -->

@endsection

@section('scripts')

<script>
    $(document).on('click','.move-to-cart', function () {
        let rowId = $(this).data('id');
        var token = "{{ csrf_token() }}";
        var path = "{{ route('wishlist.move') }}";
        $.ajax({
            url: path,
            type: "POST",
            dataType: "JSON",
            data: {
                rowId:rowId,
                _token:token
            },

            beforeSend:function(){
                $('#move_to_cart_'+rowId).html('<i class="fa fa-spinner fa-spin"></i> Moving..');
            },
            complete: function (response) {
                $('#move_to_cart_'+rowId).html(' ');
            },
            success:function(data){
                if (data['status']) {
                    //for mini cart
                    $('body #header-ajax').html(data['header']);
                    $('body #wishlist_counter').html(data['wishlist_count']);
                    $('body #wishlist_page').html(data['wishlist_page']);
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
