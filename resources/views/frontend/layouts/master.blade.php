<!doctype html>
<html lang="en">
<head>
    @include('frontend.layouts.head')
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <!-- Header Area -->
    <header class="header_area" >
    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-6">
                    <div class="welcome-note">
                        <span class="popover--text" data-toggle="popover" data-content="Welcome to Bigshop ecommerce template."><i class="icofont-info-square"></i></span>
                        <span class="text">Welcome to {{ get_setting('title') }}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="language-currency-dropdown d-flex align-items-center justify-content-end">
                        <!-- Language Dropdown -->
                        <div class="language-dropdown">
                            <div class="dropdown">
                                <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    English
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                    <a class="dropdown-item" href="#">Bangla</a>
                                    <a class="dropdown-item" href="#">Arabic</a>
                                </div>
                            </div>
                        </div>

                        <!-- Currency Dropdown -->
                        <div class="currency-dropdown">
                            <div class="dropdown">
                                @php
                                    Helper::currency_Load();
                                    $currency_code = session('currency_code');
                                    $currency_symbol = session('currency_symbol');
                                    if ($currency_symbol == "") {
                                       $system_default_currency_info = session('system_default_currency_info');
                                       $currency_code = $system_default_currency_info->code;
                                       $currency_symbol = $system_default_currency_info->symbol;
                                    }
                                @endphp
                                <a class="btn btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $currency_symbol }} {{ $currency_code }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                @foreach (App\Models\Currency::where('status','active')->get() as $currency)
                                    <a class="dropdown-item" href="javascript::void(0)" onclick="currency_change('{{ $currency['code'] }}')">{{ $currency->symbol }} {{ \Illuminate\Support\Str::upper($currency->code) }}</a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Menu -->
    <div class="bigshop-main-menu">
        <div class="container">
            <div class="classy-nav-container breakpoint-off">
                <nav class="classy-navbar" id="bigshopNav">
                    <!-- Nav Brand -->
                    <a href="{{ url('/') }}" class="nav-brand"><img src="{{ asset(get_setting('logo')) }}" alt="logo"></a>

                    <!-- Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- Close -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav -->
                        <div class="classynav">
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('shop') }}">Shop</a>
                                </li>
                                <li><a href="contact.html">Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="hero_meta_area ml-auto d-flex align-items-center justify-content-end" id="header-ajax">
                    <!-- Hero Meta -->
                        @include('frontend.layouts.header')
                    </div>
                </nav>
            </div>
        </div>
    </div>

    </header>
    <!-- Header Area End -->

       {{-- <div class="container">
        @include('backend.layouts.notification')
       </div> --}}

        {{-- ---------- main area --------  --}}
        @yield('content')

    <!-- Footer Area -->
    <footer class="footer_area section_padding_100_0">
        @include('frontend.layouts.footer')
    </footer>
    <!-- Footer Area -->
    @include('frontend.layouts.script')
</body>
</html>
