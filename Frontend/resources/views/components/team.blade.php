{{--Component: Команда :Component--}}
{{--Fields: title, subtitle, excerpt :Fields--}}
@if( $block )

    <!-- Team -->
    <section class="team wow animate__fadeIn" data-wow-delay=".1s" data-wow-offset="30">

        <!-- container -->
        <div class="container">

            @if( $block->title )
                <!-- title -->
                <h2 class="block-title team__title">
                    {{ $block->title }}
                </h2>
                <!-- end title -->
            @endif

            @if( $block->subtitle )
                <!-- excerpt -->
                <div class="team__title-descr">
                    {{ $block->subtitle }}
                </div>
                <!-- end excerpt -->
            @endif

            @if( $block->excerpt )
                <!-- excerpt -->
                <div class="team__descr">
                    {{ $block->excerpt }}
                </div>
                <!-- end excerpt -->
            @endif

            @php( $team = \Frontend\Models\About\Team::all() )

            @if( $team->count() )

                <!-- swiper -->
                <div class="team__list swiper-container team-swiper wow animate__fadeIn" data-wow-delay=".5s">

                    <!-- wrapper -->
                    <div class="swiper-wrapper">

                    @foreach( $team as $item )

                        <!-- slide -->
                            <div class="swiper-slide">

                                <!-- item -->
                                <div class="team__item">
                                    <div class="team__item-rotator"></div>

                                    <!-- card front -->
                                    <div class="team__item-front">

                                    @if ( Storage::disk('public')->exists('images/about/team/' . $item->image) )
                                        <!-- image -->
                                            <div class="team__item-image">
                                                <img
                                                        src="{{ Storage::url('images/about/team/' . $item->image) }}"
                                                        alt="{{ $item->name }}"
                                                        title="{{ $item->name }}"
                                                        loading="lazy"
                                                >
                                            </div>
                                            <!-- end image -->
                                    @endif

                                    <!-- info -->
                                        <div class="team__item-info">

                                            <!-- name -->
                                            <div class="team__item-name">
                                                {{ $item->name }}
                                            </div>
                                            <!-- end name -->

                                            @if( $item->linkedin )
                                                <a href="{{ $item->linkedin }}" target="_blank" class="team__item-linkedin"></a>
                                        @endif

                                        @if( $item->position )
                                            <!-- position -->
                                                <div class="team__item-title">
                                                    {{ $item->position }}
                                                </div>
                                                <!-- end position -->
                                        @endif

                                            @if( $item->email )

                                                <!-- Send Message -->
                                                <a href="mailto:{{ $item->email }}" class="team__item-message" target="_blank">
                                                    {{ __( 'Написать сообщение' ) }}
                                                </a>
                                                <!-- End Send Message -->

                                            @endif

                                        </div>
                                        <!-- end info -->

                                    </div>
                                    <!-- end card front -->

                                    <!-- card back -->
                                    <div class="team__item-back">
                                        @if ( $item->image_revert && Storage::disk('public')->exists('images/about/team/' . $item->image_revert) )
                                            <div class="team__item-image">
                                                <img
                                                        src="{{ Storage::url('images/about/team/' . $item->image_revert) }}"
                                                        alt="{{ $item->name }}"
                                                        title="{{ $item->name }}"
                                                        loading="lazy"
                                                >
                                            </div>
                                    @endif

                                    <!-- description -->
                                        <div class="team__item-descr">
                                            {!! $item->description !!}
                                        </div>
                                        <!-- end description -->

                                    </div>
                                    <!-- end card back -->

                                </div>
                                <!-- end item -->

                            </div>
                            <!-- end slide -->

                        @endforeach

                    </div>
                    <!-- end wrapper -->

                    <!-- wrapper > pagination -->
                    <div class="swiper-controls centered">
                        <button class="swiper-button swiper-button-prev"></button>
                        <div class="swiper-pagination"></div>
                        <button class="swiper-button swiper-button-next"></button>
                    </div>
                    <!-- end wrapper > pagination -->

                </div>
                <!-- end swiper -->

            @endif

        </div>
        <!-- end container -->

    </section>
    <!-- End Team -->

@endif
