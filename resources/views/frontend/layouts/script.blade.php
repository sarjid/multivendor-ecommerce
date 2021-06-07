
 <!-- jQuery (Necessary for All JavaScript Plugins) -->
 <script src="{{ asset('frontend/js') }}/jquery.min.js"></script>
 <script src="{{ asset('frontend/js') }}/popper.min.js"></script>
 <script src="{{ asset('frontend/js') }}/bootstrap.min.js"></script>
 <script src="{{ asset('frontend/js') }}/jquery.easing.min.js"></script>
 <script src="{{ asset('frontend/js') }}/default/classy-nav.min.js"></script>
 <script src="{{ asset('frontend/js') }}/owl.carousel.min.js"></script>
 <script src="{{ asset('frontend/js') }}/default/scrollup.js"></script>
 <script src="{{ asset('frontend/js') }}/waypoints.min.js"></script>
 <script src="{{ asset('frontend/js') }}/jquery.countdown.min.js"></script>
 <script src="{{ asset('frontend/js') }}/jquery.counterup.min.js"></script>
 <script src="{{ asset('frontend/js') }}/jquery-ui.min.js"></script>
 <script src="{{ asset('frontend/js') }}/jarallax.min.js"></script>
 <script src="{{ asset('frontend/js') }}/jarallax-video.min.js"></script>
 <script src="{{ asset('frontend/js') }}/jquery.magnific-popup.min.js"></script>
 <script src="{{ asset('frontend/js') }}/jquery.nice-select.min.js"></script>
<script src="{{ asset('frontend/js') }}/sweetalert.min.js"></script>
 <script src="{{ asset('frontend/js') }}/wow.min.js"></script>
 <script src="{{ asset('frontend/js') }}/default/active.js"></script>
 <script>
    setTimeout(function(){
        $('#alert').slideUp();
    }, 4000);
</script>

@yield('scripts')
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

