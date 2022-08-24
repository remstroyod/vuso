@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @if( $page->is_breadcrumbs )
        {{ Breadcrumbs::render('articles') }}
    @endif

    <!-- News -->
    <section class="news">

        <!-- container -->
        <div class="container">

            <!-- header -->
            <div class="news__head">

                @include( 'partials.page-title' )

                @include( 'forms.search', [ 'scrollTo' => '#articles' ] )

            </div>
            <!-- end header -->

            @if( count($items) )

                <!-- list -->
                <div class="news__list">

                    @foreach( $items as $item )

                        @include( 'partials.loop.news', [ 'class' => ($loop->iteration === 1) ? 'photo-card' : '' ] )

                    @endforeach

                </div>
                <!-- end list -->

                @if ( $items->hasMorePages() )
                    <!-- LoadMore -->
                    <button
                            data-href="{{ url()->full() }}"
                            data-target=".news__list"
                            data-last="{{ $items->lastPage() }}"
                            class="news__load-more loadMore"
                    >
                        {{ __( 'Загрузить еще' ) }}
                    </button>
                    <!-- End LoadMore -->
                @endif

            @else

                {{ __( 'Записи отсутствуют' ) }}

            @endif

        </div>
        <!-- end container -->

    </section>
    <!-- End News -->

    @includeWhen( $blocks, 'partials.blocks' )

@endsection

@push('custom-scripts')
    <script src="{{ asset('assets/app/js/load.more.js') }}"></script>
@endpush
