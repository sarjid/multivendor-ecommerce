<!doctype html>
<html lang="en">
<head>
    @include('backend.layouts.head')
</head>
<body class="theme-cyan">

    <!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="{{ asset('backend/assets/img/loader.gif') }}" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->

<div id="wrapper">
   @include('backend.layouts.nav')

   @include('backend.layouts.sidebar')

   @yield('backend-content')
</div>

{{-- ------------ footer script include =============  --}}
    @include('backend.layouts.footer')
</body>
</html>
