{{--Component: CTA: Что делать при страховом случае :Component--}}
{{--Fields: title :Fields--}}
@if( $block )

    <!-- section -->
    <section class="insurance-instruction insurance-instruction--support">

        <!-- container -->
        <div class="container">

            <!-- content -->
            <div class="insurance-instruction__content">

                <!-- text -->
                <div class="insurance-instruction__text">

                    @if( $block->title )
                        <!-- title -->
                        <h2 class="insurance-instruction__title">
                            {{ $block->title }}
                        </h2>
                        <!-- end title -->
                    @endif

                </div>
                <!-- end text -->

                @if( $block->elements->count() )
                    <!-- steps -->
                    <div class="insurance-instruction__steps">

                        @foreach( $block->elements as $item )
                        <!-- step -->
                        <div class="insurance-instruction__step">

                            <!-- col -->
                            <div class="insurance-instruction__step-col">

                                <!-- number -->
                                <div class="insurance-instruction__step-number">
                                    {{ $loop->iteration }}
                                </div>
                                <!-- end number -->

                                @if( $item->title )
                                    <!-- title -->
                                    <div class="insurance-instruction__step-title">
                                        {{ $item->title }}
                                    </div>
                                    <!-- end title -->
                                @endif

                            </div>
                            <!-- end col -->

                            <!-- col -->
                            <div class="insurance-instruction__step-col">

                                @if( $item->excerpt )
                                    <!-- excerpt -->
                                    <div class="insurance-instruction__step-descr">
                                        {{ $item->excerpt }}
                                    </div>
                                    <!-- end excerpt -->
                                @endif

                            </div>
                            <!-- end col -->

                        </div>
                        <!-- end step -->
                        @endforeach

                    </div>
                    <!-- end steps -->
                @endif

            </div>
            <!-- end content -->

        </div>
        <!-- end container -->

    </section>
    <!-- end section -->

@endif
