@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @php( $title = (isset($page->seo->h1)) ? $page->seo->h1 : $page->name )

    <!-- Category -->
    <section class="category">

        <!-- Banner -->
        <div class="category__banner">

            @if ( Storage::disk('public')->exists('images/catalog/category/' . $page->image) )

                <!-- Image -->
                <picture class="category__banner-bg">
                    <source
                            srcset="{{ Storage::url('images/catalog/category/' . $page->image) }}"
                            media="(min-width: 768px)"
                    >
                    <img
                            src="{{ Storage::url('images/catalog/category/' . $page->image) }}"
                            alt="{{ $title }}"
                            title="{{ $title }}"
                    >
                </picture>
                <!-- End Image -->

            @endif

            <!-- container -->
            <div class="container">

                <!-- title -->
                <h1 class="page-title category__banner-title">
                    {{ $title }}
                </h1>
                <!-- end title -->

                <!-- excerpt -->
                <div class="category__banner-descr">
                    {!! $page->excerpt !!}
                </div>
                <!-- end excerpt -->

                <!-- arrow -->
                <div class="category__banner-arrow"></div>
                <!-- end arrow -->

            </div>
            <!-- end container -->

        </div>
        <!-- End Banner -->

        @if( count($products) )

            <!-- Products -->
            <div class="category__products">

                <!-- container -->
                <div class="container">

                    @foreach( $products as $item )

                        @include( 'partials.loop.products' )

                    @endforeach
                </div>
                <!-- end container -->

            </div>
            <!-- End Products -->

        @endif

    </section>
    <!-- End Category -->

    @includeWhen( $blocks, 'partials.blocks' )

@endsection
