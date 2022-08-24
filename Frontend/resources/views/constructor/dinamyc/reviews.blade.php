<!-- section -->
<section class="row clearfix feedback">

    <!-- container -->
    <div class="container">

        @isset( $shortcode->title )
            <!-- title -->
            <h2 class="block-title d-md-none">
                {{ $shortcode->title }}
            </h2>
            <!-- end title -->
        @endisset

        <!-- row -->
        <div class="row">

            <!-- col -->
            <div class="col-4 feedback__add">

                @isset( $shortcode->title )
                    <!-- title -->
                    <h2 class="block-title d-none d-md-block">
                        {{ $shortcode->title }}
                    </h2>
                    <!-- end title -->
                @endisset

                <!-- form -->
                <div class="feedback__form">

                    @isset( $shortcode->subtitle )
                        <!-- subtitle -->
                        <h3 class="feedback__form__title">
                            {{ $shortcode->subtitle }}
                        </h3>
                        <!-- end subtitle -->
                    @endisset

                    [form template="reviews"]

                </div>
                <!-- end form -->

            </div>
            <!-- end col -->

            @if( $items->count() )

                <!-- Swiper -->
                <div class="col-8 swiper-container feedback__list feedback-slider-mobile">

                    <!-- wrapper -->
                    <div class="swiper-wrapper">

                        @foreach( $items as $item )

                            <!-- slide -->
                            <div class="swiper-slide feedback__item">

                                <!-- head -->
                                <div class="feedback__item__head">

                                    <!-- user -->
                                    <div class="feedback__item__user">

                                        @if ( Storage::disk('public')->exists('images/reviews/' . $item->image) )
                                            <!-- avatar -->
                                            <div class="feedback__item__photo">
                                                <img
                                                        src="{{ Storage::url('images/reviews/' . $item->image) }}"
                                                        alt="{{ $item->name }}"
                                                        title="{{ $item->name }}"
                                                >
                                            </div>
                                            <!-- end avatar -->
                                        @endif

                                        <!-- info -->
                                        <div class="feedback__item__info">
                                            <div class="feedback__item__name">
                                                {{ $item->name }}
                                            </div>
                                            <div class="feedback__item__date">
                                                {{ $item->published_at->format('d.m.Y') }}
                                            </div>
                                        </div>
                                        <!-- info -->

                                    </div>
                                    <!-- end user -->

                                    <!-- social -->
                                    @if( $item->source )
                                        <a href="{{ $item->source }}" class="feedback__item__social" target="_blank" rel="noindex nofollow noreferrer">
                                            <span>{{ __( 'facebook' ) }}</span>
                                        </a>
                                    @endif
                                    <!-- end social -->

                                </div>
                                <!-- end head -->

                                <!-- message -->
                                <div class="feedback__item__message">
                                    {!! $item->description !!}
                                </div>
                                <!-- end message -->

                            </div>
                            <!-- end slide -->

                        @endforeach

                    </div>
                    <!-- end wrapper -->

                    <!-- pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- end pagination -->

                </div>
                <!-- End Swiper -->

            @endif


        </div>
        <!-- end row -->

    </div>
    <!-- end container -->

</section>
<!-- end section -->
