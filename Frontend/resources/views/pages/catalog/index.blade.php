@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @if( $page->is_breadcrumbs )
        {{ Breadcrumbs::render('catalog', $page) }}
    @endif

    <!-- catalog -->
    <section class="insurance insurance--catalog">

        <!-- container -->
        <div class="container">

            <!-- header -->
            <div class="insurance__head">

                @include( 'partials.page-title' )

                @if( count($contragents) )

                    <!-- nav -->
                    <ul class="nav nav-pills">

                        @foreach( $contragents as $contragent )
                            <li class="nav-item">
                                <a
                                        class="nav-link @if( request()->routeIs('catalog.contragents.index') ) @if( app('request')->contragents->id == $contragent->id ) active @endif @else @if( $contragent->is_attach === 1 ) active @endif @endif"
                                        aria-current="page"
                                        href="{{ route('catalog.contragents.index', $contragent) }}"
                                >
                                    {{ $contragent->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <!-- end nav -->

                @endif

            </div>
            <!-- end header -->

            @if( count($categories) )

                    <!-- row -->
                    <div class="row">

                        <!-- text -->
                        <div class="col col-4 insurance__text">
                            {!! $page->description !!}
                        </div>
                        <!-- end text -->

                        <!-- cards -->
                        <div class="col col-8 insurance__cards">

                            @foreach( $categories as $category )

                                @include( 'partials.loop.catalog-category', ['item' => $category] )

                            @endforeach

                        </div>
                        <!-- end cards -->

                    </div>
                    <!-- end row -->

            @endif

        </div>
        <!-- end container -->

    </section>
    <!-- end catalog -->

    @includeWhen( $blocks, 'partials.blocks' )

@endsection
