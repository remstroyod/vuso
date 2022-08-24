<!-- Last Reviews -->
<section class="feedback">

    <!-- container -->
    <div class="container">

        <!-- title -->
        <h2 class="block-title d-md-none">
            {{ __( 'Отзывы реальных людей' ) }}
        </h2>
        <!-- end title -->

        <!-- row -->
        <div class="row">

            <!-- col -->
            <div class="col-4 feedback__add">

                <!-- title -->
                <h2 class="block-title d-none d-md-block">
                    {{ __( 'Отзывы реальных людей' ) }}
                </h2>
                <!-- end title -->

                @include( 'forms.reviews' )

            </div>
            <!-- end col -->

            <!-- col -->
            <div class="col-8 swiper-container feedback__list feedback-slider-mobile">

                <!-- swiper -->
                <div class="swiper-wrapper">

                    @foreach( $reviews as $review )

                        <!-- Slide -->
                        <div class="swiper-slide feedback__item">

                            <!-- Header -->
                            <div class="feedback__item__head">

                                <!-- user -->
                                <div class="feedback__item__user">

                                    @if ( Storage::disk('public')->exists('images/reviews/' . $review->image) )
                                        <!-- avatar -->
                                        <div class="feedback__item__photo">
                                            <img
                                                    src="{{ Storage::url('images/reviews/' . $review->image) }}"
                                                    alt="{{ $review->name }}"
                                                    title="{{ $review->name }}"
                                            >
                                        </div>
                                        <!-- end avatar -->
                                    @endif

                                    <!-- info -->
                                    <div class="feedback__item__info">

                                        <!-- name -->
                                        <div class="feedback__item__name">
                                            {{ $review->name }}
                                        </div>
                                        <!-- end name -->

                                        <!-- date -->
                                        <div class="feedback__item__date">
                                            {{ $review->published_at->format('d.m.Y') }}
                                        </div>
                                        <!-- end date -->

                                    </div>
                                    <!-- end info -->

                                </div>
                                <!-- end user -->

                                @if( $review->source )
                                    <a href="{{ $review->source }}" class="feedback__item__social" target="_blank" rel="noindex nofollow noreferrer">
                                        <span>{{ __( 'facebook' ) }}</span>
                                    </a>
                                @endif

                            </div>
                            <!-- End Header -->

                            <!-- Content -->
                            <div class="feedback__item__message">
                                {!! $review->description !!}
                            </div>
                            <!-- End Content -->

                        </div>
                        <!-- End Slide -->

                    @endforeach

                </div>
                <!-- end swiper -->

                <!-- pagination -->
                <div class="swiper-pagination"></div>
                <!-- end pagination -->

            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

    </div>
    <!-- end container -->

</section>
<!-- End Last Reviews -->
