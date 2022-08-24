{{--Component: CTA: Забота о клиентах :Component--}}
{{--Fields: title, content :Fields--}}
@if( $block )

    <!-- Banner -->
    <section class="short-stats wow animate__fadeIn" data-wow-delay=".1s" data-wow-offset="30">

        <!-- container -->
        <div class="container">

            <!-- inner -->
            <div class="short-stats__inner">

                @if( $block->title )
                    <!-- quote -->
                    <div class="short-stats__quote">
                        {{ $block->title }}
                    </div>
                    <!-- end quote -->
                @endif

                @if( $block->content )
                    {!! $block->content !!}
                @endif

            </div>
            <!-- end inner -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Banner -->

@endif
