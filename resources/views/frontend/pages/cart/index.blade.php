@extends('frontend.layouts.master')
@section('content')
    <!-- Breadcumb Area -->
    <div class="breadcumb_area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <h5>Cart</h5>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcumb Area -->

    <!-- Cart Area -->
    <div class="cart_area section_padding_100_70 clearfix">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12">
                    <div class="cart-table">
                        <div class="table-responsive" id="cart_list">
                           @include('frontend.layouts._cart-lists')
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="cart-apply-coupon mb-30">
                        <h6>Have a Coupon?</h6>
                        <p>Enter your coupon code here &amp; get awesome discounts!</p>
                        <!-- Form -->
                        <div class="coupon-form" id="coupon_form">
                            @include('frontend.layouts._coupon-form')
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="cart-total-area mb-30">
                        <h5 class="mb-3">Cart Totals</h5>
                        <div class="table-responsive" id="cart_total">
                            @include('frontend.layouts._cart-total')
                        </div>
                        <a href="{{ route('checkout1') }}" class="btn btn-primary d-block">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Area End -->
@endsection

@section('scripts')
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
                    $('body #cart_list').html(data['cart_list']);
                    $('body #cart_total').html(data['cart_total']);
                    $('body #coupon_form').html(data['coupon_form']);
                    //start alert
                    swal({
                    title: "Item Deleted!",
                    text: data['message'],
                    icon: "success",
                    button: false,
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

{{-- //increment decrement qty --}}
<script>
    $(document).on('click','.qty-text', function () {
        var id = $(this).data('id');

        var spinner = $(this),input=spinner.closest("div.quantity").find('input[type="number"]');
        if (input.val() == 0) {
            return false;
        }

        if (input.val() !=0) {
            var newVal = parseFloat(input.val());
            $('#qty-input-'+id).val(newVal);
        }

        var product_stock = $('#update-cart-'+id).data('product-quantity');
        update_cart(id,product_stock)
    });

    function update_cart(id,product_stock){
        var rowId = id;
        var product_qty = $('#qty-input-'+rowId).val();
        var token = "{{ csrf_token() }}";
        var path= "{{ route('cart.update') }}";
        $.ajax({
            type: "POST",
            url: path,
            data: {
                _token:token,
                rowId:rowId,
                product_qty:product_qty,
                product_stock:product_stock
            },
            success: function (data) {
                console.log(data)
                if (data['status']) {
                    //for mini cart
                    $('body #header-ajax').html(data['header']);
                    $('body #cart_list').html(data['cart_list']);
                    $('body #cart_total').html(data['cart_total']);
                    $('body #coupon_form').html(data['coupon_form']);
                    alert(data['message']);
                    //start alert
                    // swal({
                    // title: "Item Updated!",
                    // text: data['message'],
                    // icon: "warning",
                    // button: false,
                    // });
                    //end alert
                }else{
                    alert(data['message']);
                }
            }
        });
    }
</script>

{{-- //coupon apply  --}}
<script>
    $('.coupon-btn').click(function (e) {
        e.preventDefault();
        var code = $('input[name=code]').val();
        $('.coupon-btn').html('<i class="fa fa-spinner fa-spin"></i> Applying..');
        $('#coupon-form').submit();
    });
</script>
@endsection
