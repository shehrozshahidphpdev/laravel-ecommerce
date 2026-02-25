@props(['title', 'categories'])

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title ?? 'EcommerceApp' }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('user/assets/img/logo/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/flaticon_shofy.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/font-awesome-pro.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
    {{-- intel tel input cdn link --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/css/intlTelInput.css">

</head>


<body>


    <x-toast />

    {{-- Rest of your components --}}
    <x-user.partials.top-navigate />
    <x-user.partials.side-menu />
    <x-user.partials.mobile-menu />
    <x-user.partials.mobile-seach-bar />
    <x-user.partials.mini-cart />
    <x-user.partials.desktop-header :categories="$categories" />
    <x-user.partials.mobile-header />

    <main> {{ $slot }} </main>

    <x-user.partials.footer />

    <!-- All your scripts -->
    <script src="{{ asset('user/assets/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('user/assets/js/vendor/waypoints.js') }}"></script>
    <script src="{{ asset('user/assets/js/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('user/assets/js/meanmenu.js') }}"></script>
    <script src="{{ asset('user/assets/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('user/assets/js/slick.js') }}"></script>
    <script src="{{ asset('user/assets/js/range-slider.js') }}"></script>
    <script src="{{ asset('user/assets/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('user/assets/js/nice-select.js') }}"></script>
    {{--
    <script src="{{ asset('user/assets/js/purecounter.js') }}"></script> --}}
    {{--
    <script src="{{ asset('user/assets/js/countdown.js') }}"></script> --}}
    {{--
    <script src="{{ asset('user/assets/js/wow.js') }}"></script> --}}
    <script src="{{ asset('user/assets/js/isotope-pkgd.js') }}"></script>
    <script src="{{ asset('user/assets/js/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ asset('user/assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('user/assets/js/main.js') }}"></script>
    {{-- Toast JS - KEEP THIS AT THE END --}}
    {{-- MOVE TOAST COMPONENT HERE - RIGHT AFTER BODY TAG --}}
    <script src="{{ asset('assets/js/toast.js') }}"></script>
    {{-- intel tel input cdn script link --}}
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.4/build/js/intlTelInput.min.js"></script>

    @stack('script')
</body>

</html>