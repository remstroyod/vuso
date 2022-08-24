{{--Component: Популярные продукты :Component--}}
{{--Fields: title :Fields--}}
@if( $block )

{{--
    <!-- Section -->
    <section class="">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- col -->
                <div class="col-12">
--}}

                    <!-- products -->
                    <div class="search-results__group search-results__group--popular-products">
                        @if( $block->title )
                            <h2 class="search-results__group-title">
                                {{ $block->title }}
                            </h2>
                        @endif
                        <ul class="search-results__group-list">
                            @if( $block->elements->count() )
                                @foreach( $block->elements as $item )
                                    @include( 'partials.loop.products-no-photo', [ 'item' => $item, 'is_blocks' => true ] )
                                @endforeach
                            @else
                                @php( $products = \Frontend\Models\Catalog\Product::popular(3)->get() )
                                @if( $products->count() )
                                    @foreach( $products as $item )
                                        @include( 'partials.loop.products-no-photo', [ 'item' => $item ] )
                                    @endforeach
                                @endif
                            @endif
                        </ul>
                    </div>
                    <!-- end products -->

{{--
                </div>
                <!-- end col -->

            </div>
            <!-- end row -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Section -->
--}}

@endif
