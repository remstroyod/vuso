@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @if( $page->is_breadcrumbs )
        {{ Breadcrumbs::render('informations') }}
    @endif

    <!-- Text -->
    <section class="info-text info-text--reports-offers">

        <div class="container">

            <div class="info-text__head">

                @include( 'partials.page-title' )
                @include( 'forms.search' )

            </div>

            <div class="info-text__body">

                <div class="info-text__sidebar">

                    @include( 'pages.informations.item-tab', ['categories' => $categories] )

                    @includeWhen( $blocks, 'partials.blocks', [ 'blocks' => $blocks->where('position', 'left') ] )

                </div>

                <div class="info-text__tabs">

                @includeWhen( count($categories), 'partials.accordion.sidebar.tab', [ 'categories' => $categoriesTab ] )

                </div>

            </div>
        </div>
    </section>
    <!-- End Text -->

    @includeWhen( $blocks, 'partials.blocks', [ 'blocks' => $blocks->where('position', 'bottom') ] )

@endsection
