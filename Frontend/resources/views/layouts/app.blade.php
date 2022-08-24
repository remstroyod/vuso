<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Plugins Styles -->
    @stack('plugin-styles')

    <!-- Styles -->
    <link href="{{ asset('assets/app/css/styles.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/app/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/app/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/app/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/app/img/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/app/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">

    <!-- Meta -->
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="canonical" href="{{url()->current()}}">

    @yield('meta')

    {{-- <script>
        const   VUSO_USER_ID    = {{ Auth::check() ? Auth::id() : 'null' }},
                VUSO_LANG       = '{{ app()->getLocale() }}',
                VUSO_PRODUCT    = {{ (request()->routeIs('catalog.product.index') && !empty($page)) ? $page->id : 'null' }};
    </script> --}}

</head>
<body class="@if( ! request()->routeIs('home') ) inner-page @endif @isset( $body_class ) {{ $body_class }} @endisset">

    <!-- Wrapper -->
    <div class="wrapper">

        @include('partials.header')

        <!-- Content -->
        <main class="content">

            @yield('content')

            @isset( $page->seo )

                @includeWhen( $page->seo->text, 'partials.seo', ['text' => $page->seo->text] )

            @endisset

        </main>
        <!-- End Content -->

        @include('partials.footer')

        @includeWhen( !auth()->check(), 'partials.modal.auth' )

        @include( 'partials.modal.video' )
        @include( 'partials.modal.reviews' )
        @include( 'partials.modal.success' )

        @includeWhen( auth()->check(), 'partials.modal.cart-remove' )

    </div>
    <!-- End Wrapper -->

    <!-- Scripts Frontend -->
    {{--<script src="{{ asset('assets/app/js/jquery.js') }}"></script>--}}
    <script src="{{ asset('assets/app/js/scripts.js') }}"></script>

    <!-- Scripts -->
    <script src="{{ asset('assets/app/js/forms.js') }}"></script>

    {{--<script src="{{ asset('assets/app/js/share.js') }}"></script>--}}

    <script src="{{ asset('assets/app/js/payment.js') }}"></script>

    @if( ! Auth::check() )
        <script src="{{ asset('assets/app/js/auth.js') }}"></script>
    @endif
    <script src="{{ asset('assets/app/js/pay.js') }}"></script>

    @if( auth()->check() )
        <script src="{{ asset('assets/app/js/cart.js') }}"></script>
    @endif

    @stack('custom-scripts')

    {!! app('captcha')->renderFooterJS(app()->getLocale()) !!}

</body>
</html>
