{{--Component: Награды :Component--}}
{{--Fields: title :Fields--}}
@if( $block )

    <!-- Awards -->
    <section class="awards wow animate__fadeIn" data-wow-delay=".1s" data-wow-offset="30">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- col -->
                <div class="col-4">

                    @if( $block->title )
                        <!-- excerpt -->
                        <div class="awards__text">
                            {{ $block->title }}
                        </div>
                        <!-- end excerpt -->
                    @endif

                </div>
                <!-- end col -->

                <!-- col -->
                <div class="col-8">

                    @php( $awards = \Frontend\Models\About\Awards::all() )

                    <!-- swiper -->
                    <div class="awards__list swiper-container awards-swiper">

                        <!-- wrapper -->
                        <div class="swiper-wrapper">

                        @foreach( $awards as $item )

                            <!-- slide -->
                                <div class="swiper-slide">

                                    <!-- item -->
                                    <div class="awards__item">

                                        <!-- header -->
                                        <div class="awards__item-head">

                                            @if( $item->file )
                                                <!-- file -->
                                                <a href="{{ Storage::url('files/about/awards/' . $item->file) }}" class="awards__item-pdf" target="_blank">
                                                    {{ __( 'Открыть' ) }} .{{ \Illuminate\Support\Str::after($item->file, '.') }}
                                                </a>
                                                <!-- end file -->
                                            @endif

                                            <!-- title -->
                                            <div class="awards__item-title">
                                                {{ $item->name }}
                                            </div>
                                            <!-- end title -->

                                        </div>
                                        <!-- end header -->

                                        <!-- body -->
                                        <div class="awards__item-body">

                                            <!-- params -->
                                            <div class="awards__item-params">

                                            @if( $item->nomination )

                                                <!-- group -->
                                                    <div class="awards__item-params__group">

                                                        <!-- title -->
                                                        <div class="awards__item-params__group-title">
                                                            {{ __( 'Номинация' ) }}
                                                        </div>
                                                        <!-- end title -->

                                                        <!-- value -->
                                                        <div class="awards__item-params__group-value">
                                                            «{{ $item->nomination }}»
                                                        </div>
                                                        <!-- end value -->

                                                    </div>
                                                    <!-- end group -->

                                            @endif

                                            @if( $item->from )

                                                <!-- group -->
                                                    <div class="awards__item-params__group">

                                                        <!-- title -->
                                                        <div class="awards__item-params__group-title">
                                                            {{ __( 'От' ) }}
                                                        </div>
                                                        <!-- end title -->

                                                        <!-- value -->
                                                        <div class="awards__item-params__group-value">
                                                            {!! $item->from !!}
                                                        </div>
                                                        <!-- end value -->

                                                    </div>
                                                    <!-- end group -->

                                                @endif

                                            </div>
                                            <!-- end params -->

                                            <!-- date -->
                                            <div class="awards__item-date">
                                                {{ Carbon\Carbon::parse($item->date)->format('Y') }}
                                            </div>
                                            <!-- end date -->

                                        </div>
                                        <!-- end body -->

                                    </div>
                                    <!-- end item -->

                                </div>
                                <!-- end slide -->

                            @endforeach

                        </div>
                        <!-- end wrapper -->

                        <!-- pagination -->
                        <div class="swiper-controls">
                            <button class="swiper-button swiper-button-prev"></button>
                            <div class="swiper-pagination"></div>
                            <button class="swiper-button swiper-button-next"></button>
                        </div>
                        <!-- end pagination -->

                    </div>
                    <!-- end swiper -->

                </div>
                <!-- end col -->

            </div>
            <!-- end row -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Awards -->

@endif
