{{--Component: Акции :Component--}}
{{--Fields: title :Fields--}}
@if( $block )

    <!-- actions -->
    <section class="actions">

        <!-- container -->
        <div class="container">

            @if( $block->title )
                <!-- title -->
                <h2 class="block-title">
                    {{ $block->title }}
                </h2>
                <!-- end title -->
            @endif

            @php( $sales = \Frontend\Models\Articles\Articles::lastSales(3)->get() )

            @if( $sales->count() )

                <!-- list -->
                <div class="actions__list">

                    @foreach( $sales as $item )

                        @include( 'partials.loop.news' )

                    @endforeach

                </div>
                <!-- end list -->

            @endif

        </div>
        <!-- end container -->

    </section>
    <!-- end actions -->

@endif
