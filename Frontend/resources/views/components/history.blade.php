{{--Component: История :Component--}}
{{--Fields: title, subtitle :Fields--}}
@if( $block )

    <!-- Chronology -->
    <section class="chronology wow animate__fadeIn" data-wow-delay=".1s" data-wow-offset="30">

        <!-- container -->
        <div class="container">

            @if( $block->title )
                <!-- title -->
                <div class="chronology__title">
                    {{ $block->title }}
                </div>
                <!-- end title -->
            @endif

            @if( $block->subtitle )
                <!-- excerpt -->
                <div class="chronology__descr">
                    {{ $block->subtitle }}
                </div>
                <!-- end excerpt -->
            @endif

            @php( $history = \Frontend\Models\About\History::all() )

            @if( $history->count() )
            <!-- list -->
            <div class="chronology__list">

                <!-- swiper -->
                <div class="swiper-container chronology-swiper">

                    <!-- wrapper -->
                    <div class="swiper-wrapper">

                    @foreach( $history as $item )

                        <!-- slide -->
                            <div class="swiper-slide">

                                <!-- item -->
                                <div class="chronology__item {{ ($item->select == 'green') ? 'past' : '' }} {{ ($item->year == Carbon\Carbon::now()->year) ? 'current' : '' }}">

                                    <!-- excerpt -->
                                    <div
                                            class="chronology__item-descr"
                                            @if( $item->hint )
                                                data-bs-toggle="popover"
                                                data-bs-placement="bottom"
                                                data-bs-trigger="hover focus"
                                                data-bs-content="{{ $item->hint }}"
                                            @endif
                                    >
                                        {{ $item->name }}
                                    </div>
                                    <!-- end excerpt -->

                                    <!-- year -->
                                    <div class="chronology__item-year">
                                        {{ $item->year }}
                                    </div>
                                    <!-- end year -->

                                </div>
                                <!-- end item -->

                            </div>
                            <!-- end slide -->

                        @endforeach

                    </div>
                    <!-- end wrapper -->

                </div>
                <!-- end swiper -->

            </div>
            <!-- end list -->
            @endif

        </div>
        <!-- end container -->

    </section>
    <!-- End Chronology -->

@endif
