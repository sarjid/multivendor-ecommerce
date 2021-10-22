
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
 {{-- ---------autosearch----------- --}}
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('frontend/js') }}/sweetalert.min.js"></script>
 <script src="{{ asset('frontend/js') }}/wow.min.js"></script>
 <script src="{{ asset('frontend/js') }}/default/active.js"></script>
 <script src="{{ asset('frontend/js') }}/bootstrap-notify.js"></script>
<script>
    @if (\Illuminate\Support\Facades\Session::has('success'))
        $.notify("Success: {{ \Illuminate\Support\Facades\Session::get('success') }}", {
        type:'success',
        placement: {
		    from: "bottom",
            align: "left",
	    },
        animate: {
            enter: 'animated fadeInLeft',
            exit: 'animated fadeOutLeft'
        }
    });
    @endif
    @php
    \Illuminate\Support\Facades\Session::forget('success')
    @endphp


    @if (\Illuminate\Support\Facades\Session::has('error'))
        $.notify("Sorry: {{ \Illuminate\Support\Facades\Session::get('error') }}", {
        type:'danger',
        placement: {
		    from: "bottom",
            align: "left",
	    },
        animate: {
            enter: 'animated fadeInLeft',
            exit: 'animated fadeOutLeft'
        }
    });
    @endif
    @php
    \Illuminate\Support\Facades\Session::forget('error')
    @endphp
</script>

 <script>
     $(document).ready(function () {
        var path = "{{ route('autosearch') }}";
        $('#search_text').autocomplete({
            source:function(request,response){
                $.ajax({
                    url: path,
                    dataType: "JSON",
                    data: {
                        term:request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength:1,
        });
     });
 </script>

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


{{-- ///currecy change  --}}
<script>
    function currency_change(currency_code){
        $.ajax({
            type: "post",
            url: "{{ route('currency.load') }}",
            data: {
                currency_code:currency_code,
                _token: '{{csrf_token()}}',
            },
            success: function (response) {
                if (response.status) {
                    location.reload();
                }else{
                    alert('server error');
                }
            }
        });
    }
</script>

