<!-- section -->
<section class="row clearfix action">

    <!-- products -->
    <div class="action__products">

        <!-- container -->
        <div class="container">

            @isset( $shortcode->title )

                <!-- title -->
                <div class="action__products-title">
                    {{ $shortcode->title }}
                </div>
                <!-- end title -->

            @endisset

            @if( $items->count() )

                <!-- list -->
                <div class="action__products-list">

                    @foreach( $items as $item )

                        <!-- card -->
                        <div class="product-card">

                            @if( $item->name )

                                <!-- title -->
                                <div class="product-card__title">
                                    {{ $item->name }}
                                </div>
                                <!-- end title -->

                            @endif

                            @if( $item->description )

                                <!-- descr -->
                                <div class="product-card__descr">
                                    {!! $item->description !!}
                                </div>
                                <!-- end descr -->

                            @endif

                            @if( $item->url_one || $item->url_two )

                                <!-- controls -->
                                <div class="product-card__controls">

                                    @if( $item->url_one )
                                        <a href="{{ $item->url_one }}" class="btn yellow product-card__order">
                                            {{ $item->url_one_title }}
                                        </a>
                                    @endif

                                    @if( $item->url_two )
                                        <a href="{{ $item->url_two }}" class="product-card__details">
                                            {{ $item->url_two_title }}
                                        </a>
                                    @endif

                                </div>
                                <!-- end controls -->

                            @endif

                        </div>
                        <!-- end card -->

                    @endforeach

                </div>
                <!-- end list -->

            @endif

        </div>
        <!-- end container -->

    </div>
    <!-- end products -->

</section>
<!-- end section -->
