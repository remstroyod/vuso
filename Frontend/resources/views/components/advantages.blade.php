{{--Component: Преимущества :Component--}}
{{--Fields: title :Fields--}}
@if( $block )

    @if( $block->elements->count() )
        <!-- Advantages -->
        <section class="text-advantage">

            <!-- container -->
            <div class="container">

                @foreach( $block->elements as $item )
                    <!-- item -->
                    <div class="text-advantage__item">

                        @if( $item->title )
                            <!-- title -->
                            <div class="text-advantage__item-title">
                                {{ $item->title }}
                            </div>
                            <!-- end title -->
                        @endif

                        @if( $item->excerpt )
                        <!-- excerpt -->
                        <div class="text-advantage__item-descr">
                            {{ $item->excerpt }}
                        </div>
                        <!-- end excerpt -->
                        @endif

                    </div>
                    <!-- end item -->
                @endforeach

            </div>
            <!-- end container -->

        </section>
        <!-- End Advantages -->
    @endif

@endif
