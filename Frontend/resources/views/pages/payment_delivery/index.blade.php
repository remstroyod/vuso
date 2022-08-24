@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @if( $page->is_breadcrumbs )
        {{ Breadcrumbs::render('payment_delivery') }}
    @endif

    <!-- Text -->
    <section class="info-text info-text--delivery-payment">

        <!-- container -->
        <div class="container">

            <!-- header -->
            <div class="info-text__head">

                @include( 'partials.page-title' )

                @include( 'forms.search' )

            </div>
            <!-- end header -->

            <!-- body -->
            <div class="info-text__body">

                <!-- sidebar -->
                <div class="info-text__sidebar">

                    <!-- list -->
                    <ul>

                        @foreach( $categories as $category )

                            <li tab-id="{{ $category->id }}" class="@if( $loop->iteration == 1 ) active @endif">
                                <span  class="">{{ $category->name }}</span>

                                <div class="info-text__items-mobile">
                                    <h3 class="info-text__tab-title">
                                        {{ $category->name }}
                                    </h3>
                                    {!! $category->description !!}
                                </div>
                            </li>

                        @endforeach

                    </ul>
                    <!-- end list -->

                    @includeWhen( $blocks, 'partials.blocks', [ 'blocks' => $blocks->where('position', 'left') ] )

                </div>
                <!-- end sidebar -->

                <!-- tabs -->
                <div class="info-text__tabs">

                    @includeWhen( count($categories), 'partials.accordion.sidebar.tab', [ 'items' => $categories ] )

                </div>
                <!-- end tabs -->

            </div>
            <!-- end body -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Text -->

    @includeWhen( $blocks, 'partials.blocks', [ 'blocks' => $blocks->where('position', 'bottom') ] )

@endsection
