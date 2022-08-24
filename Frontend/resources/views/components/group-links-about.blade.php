{{--Component: About: Группа ссылок :Component--}}
{{--Fields: title :Fields--}}
@if( $block )

    <!-- Info -->
    <section class="company-info wow animate__fadeIn" data-wow-delay=".1s" data-wow-offset="30">

        <!-- container -->
        <div class="container">

            <!-- swiper -->
            <div class="company-info__sections swiper-container company-sections-swiper">

                <!-- wrapper -->
                <div class="swiper-wrapper">

                    @if( $block->elements->count() )

                        @foreach( $block->elements as $item )

                            <!-- slide -->
                            <div class="swiper-slide">

                                <!-- section -->
                                <div class="company-info__section">

                                    @if( $item->title )

                                        <!-- title -->
                                        <div class="company-info__section-title">
                                            {{ $item->title }}
                                        </div>
                                        <!-- end title -->

                                    @endif

                                    @if( $item->link )

                                        <!-- link -->
                                        <a href="{{ $item->link }}" class="company-info__section-link">

                                            @if( $item->linktext )
                                                {{ $item->linktext }}
                                            @endif

                                        </a>
                                        <!-- end link -->

                                    @endif

                                </div>
                                <!-- end section -->

                            </div>
                            <!-- end slide -->

                        @endforeach

                    @endif

                </div>
                <!-- end wrapper -->

                <!-- pagination -->
                <div class="swiper-pagination"></div>
                <!-- end pagination -->

            </div>
            <!-- end swiper -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Info -->

@endif
