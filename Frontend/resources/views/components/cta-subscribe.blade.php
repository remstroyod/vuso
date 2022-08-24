{{--Component: CTA: Подписаться на рассылку :Component--}}
{{--Fields: title, excerpt :Fields--}}
@if( $block )

    <!-- Subscribe -->
    <section class="subscribe">

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

                @include( 'forms.subscribe' )

            </div>
            <!-- end inner -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Subscribe -->


@endif
