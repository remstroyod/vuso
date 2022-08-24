{{--Component: CTA: Станьте новым партнёром :Component--}}
{{--Fields: title, excerpt :Fields--}}
@if( $block )

    <!-- Subscribe -->
    <section class="subscribe wow animate__fadeIn" data-wow-delay=".1s" data-wow-offset="30" id="become-partner-subscribe">

        <!-- container -->
        <div class="container">

            <!-- inner -->
            <div class="subscribe__inner">

                <!-- text -->
                <div class="subscribe__text">

                    @if( $block->title )
                        <!-- title -->
                        <h2 class="subscribe__title">
                            {{ $block->title }}
                        </h2>
                        <!-- end title -->
                    @endif

                    @if( $block->excerpt )
                        <!-- excerpt -->
                        <div class="subscribe__descr">
                            {{ $block->excerpt }}
                        </div>
                        <!-- end excerpt -->
                    @endif

                </div>
                <!-- end text -->

                @include( 'forms.partners-new' )

            </div>
            <!-- end inner -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Subscribe -->

@endif
