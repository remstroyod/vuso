@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    <!-- results -->
    <section class="search-results">
        <div class="container">
            <div class="search-results__head">
                @include( 'partials.page-title', [ 'class' => 'search-results__title' ] )
                @if( $count == 0 )
                    <div class="search-results__descr">
                        {{ __( 'По Вашему запросу "' . request()->q . '" ничего не найдено...' ) }}
                    </div>
                    <div class="search-results__annotation">
                        {{ __( 'Возможно Вы допустили грамматическую ошибку или опечатку. Пожалуйста проверьте правильность написания или попробуйте изменить формулировку' ) }}
                    </div>
                @else
                    <div class="search-results__descr">
                        {{ __( 'По Вашему запросу "' . request()->q . '" найдено ' . $count . ' результатов' ) }}
                    </div>
                @endif
                @include( 'forms.search', [ 'class' => 'search-results__search' ] )
            </div>

            @if( $products->count() )
                <div class="search-results__group search-results__group--products" id="products">
                    <h2 class="search-results__group-title">
                        {{ __( 'Страховые продукты' ) }}
                    </h2>
                    <div class="search-results__group-slider">
                        <div class="swiper-container js-search-products-swiper">
                            <div class="swiper-wrapper">
                                @foreach( $products as $item )
                                    <div class="swiper-slide">
                                        @include( 'partials.loop.products-no-photo' )
                                    </div>
                                @endforeach
                            </div>

                            <div class="swiper-controls">
                                <button class="swiper-button swiper-button-prev"></button>
                                <div class="swiper-pagination"></div>
                                <button class="swiper-button swiper-button-next"></button>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

            @if( $articles->count() )
                <div class="search-results__group search-results__group--news" id="articles">
                    <h2 class="search-results__group-title">
                        {{ __( 'Найденные новости' ) }}
                    </h2>
                    <ul class="search-results__group-list">
                        @foreach( $articles as $item )
                            @include( 'partials.loop.news', [ 'item' => $item ] )
                        @endforeach
                    </ul>
                </div>
            @endif

            @if( $informations->count() )
                <div class="search-results__group search-results__group--docs" id="documents">
                    <h2 class="search-results__group-title">
                        {{ __( 'Найденные документы' ) }}
                    </h2>
                    <ul class="search-results__group-list search-results__group-list--docs">
                        @foreach( $informations as $item )
                            @include( 'partials.loop.informations-item', [ 'item' => $item, 'hidden' => 5 ] )
                        @endforeach
                    </ul>

                    @if( $informations->count() > 5 )
                        <div class="search-results__group-controls">
                            <button class="search-results__group-loadmore">
                                {{ __( 'Показать ещё' ) }}
                            </button>
                            <div class="search-results__group-pagination">
                                <span>1-5</span> {{ __( 'из' ) }} <span>{{ $informations->count() }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            @if( $pages->count() )
                <div class="search-results__group search-results__group--other-pages" id="pages">
                    <h2 class="search-results__group-title">
                        {{ __( 'Найденные страницы' ) }}
                    </h2>
                    <ul class="search-results__group-list search-results__group-list--links">
                        @foreach( $pages as $item )
                            <li>
                                <a href="{{ $item->type == 1 ? url($item->page) : url('landing-page/' . $item->page) }}" class="search-results__group-link">
                                    {{ $item->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @includeWhen( $blocks, 'partials.blocks' )
        </div>

    </section>
    <!-- end results -->


@endsection
