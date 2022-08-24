@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    {{ Breadcrumbs::render('partners') }}

    @includeWhen( $blocks, 'partials.blocks', ['blocks'=> $blocks->where('position', 'top')])

    <!-- Partners -->
    <section class="partners">

        <!-- container -->
        <div class="container">

            <!-- header -->
            <div class="partners__head">

                @include( 'partials.page-title', [ 'class' => 'partners__title' ] )

                <!-- button -->
                <a href="#become-partner-subscribe" class="btn blue partners__join-btn">
                    {{ __( 'Стать партнёром' ) }}
                </a>
                <!-- end button -->

                @if( $page->description )
                    <!-- content -->
                    <div class="partners__descr">
                        {!! $page->description !!}
                    </div>
                    <!-- end content -->
                @endif

                @if( count($categories) )

                    <!-- categories -->
                    <div class="partners__categories">

                        <!-- list -->
                        <ul class="nav nav-pills partners__pills">

                            @foreach( $categories as $category )
                                <li class="nav-item">
                                    <a
                                            class="nav-link @if( request()->routeIs('partners.index') ) @if( $loop->iteration === 1 ) active @endif @else @if( app('request')->categories->id == $category->id ) active @endif @endif"
                                            href="{{ route('partners.category', $category) }}"
                                    >
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <!-- end list -->

                    </div>
                    <!-- end categories -->

                @endif

            </div>
            <!-- end header -->

            @if( count($items) )

                <!-- list -->
                <div class="partners__list">

                    @foreach( $items as $item )

                       @include( 'partials.loop.partners', $item )

                    @endforeach

                </div>
                <!-- end list -->

            @endif

        </div>
        <!-- end container -->

    </section>
    <!-- End Partners -->

    @includeWhen( $blocks, 'partials.blocks', ['blocks'=> $blocks->where('position', 'bottom')] )

@endsection
