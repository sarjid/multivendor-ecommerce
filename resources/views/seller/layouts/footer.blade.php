<!-- Javascript -->

<script src="{{ asset('backend/assets') }}/vendor/jquery-3.2.1.min.js"></script>
<script src="{{ asset('backend/assets') }}/bundles/libscripts.bundle.js"></script>
<script src="{{ asset('backend/assets') }}/bundles/vendorscripts.bundle.js"></script>
<script src="{{ asset('backend/assets') }}/bundles/datatablescripts.bundle.js"></script>
<script src="{{ asset('backend/assets') }}/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="{{ asset('backend/assets') }}/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->
<script src="{{ asset('backend/assets') }}/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
<script src="{{ asset('backend/assets') }}/vendor/select2/select2.min.js"></script> <!-- Select2 Js -->
<script src="{{ asset('backend/assets') }}/bundles/mainscripts.bundle.js"></script>
<script src="{{ asset('backend/assets') }}/js/pages/tables/jquery-datatable.js"></script>
<script src="{{  asset('backend/assets')  }}/vendor/summernote/dist/summernote.js"></script>
<script src="{{ asset('backend/assets') }}/vendor/switch-button-bootstrap/bootstrap-switch-button.min.js""></script>
<script src="{{ asset('backend/assets') }}/js/index4.js"></script>
<script src="{{ asset('frontend/js') }}/bootstrap-notify.js"></script>
@yield('scripts')
<script>
    setTimeout(function(){
        $('#alert').slideUp();
    }, 4000);
</script>

<script>
    @if (\Illuminate\Support\Facades\Session::has('success'))
        $.notify("Success: {{ \Illuminate\Support\Facades\Session::get('success') }}", {
        type:'success',
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


