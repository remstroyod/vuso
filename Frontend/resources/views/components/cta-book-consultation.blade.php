{{--Component: CTA: Забронировать консультацию :Component--}}
{{--Fields: title, excerpt, subtitle :Fields--}}
@if( $block )

    <!-- Consult -->
    <section class="consult wow animate__fadeIn" data-wow-delay=".1s" data-wow-offset="30">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- col -->
                <div class="col-4 consult__text">

                    @if( $block->title )
                        <!-- title -->
                        <h2 class="block-title">
                            {{ $block->title }}
                        </h2>
                        <!-- title -->
                    @endif

                    @if( $block->excerpt )
                        <!-- excerpt -->
                        <div class="consult__descr">
                            {{ $block->excerpt }}
                        </div>
                        <!-- end excerpt -->
                    @endif

                </div>
                <!-- end col -->

                <!-- col -->
                <div class="col-8 consult__order">

                    @if( $block->subtitle )
                        <!-- title -->
                        <div class="consult__order-title">
                            {{ $block->subtitle }}
                        </div>
                        <!-- end title -->
                    @endif

                    @include( 'forms.book-time-2' )

                </div>
                <!-- end col -->

            </div>
            <!-- end row -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Consult -->

@endif
