@extends('layouts.app', ['body_class' => 'with-bg'])

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @if( $page->is_breadcrumbs )
        {{ Breadcrumbs::render('payment') }}
    @endif

    <!-- Section -->
    <div class="payment-sections">

        @include( 'pages.payment.form' )

    </div>
    <!-- End Section -->

    @includeWhen( $blocks, 'partials.blocks' )

@endsection

@push('custom-scripts')
    <script src="{{ asset('assets/app/js/payment.js') }}"></script>
@endpush
