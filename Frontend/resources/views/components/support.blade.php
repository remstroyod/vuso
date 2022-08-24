{{--Component: Поддержка :Component--}}
{{--Fields: title, subtitle, excerpt :Fields--}}
@if( $block )

    <!-- Text -->
    <section class="support">

        <!-- container -->
        <div class="container">

            @if( $block->title )
                <!-- title -->
                <h1 class="page-title">
                    {{ $block->title }}
                </h1>
                <!-- end title -->
            @endif

            <!-- content -->
            <div class="support__content">

                @includeWhen( $page->faqs, 'partials.accordion.faq.tabs', [ 'items' => $page->faqs ] )

                <!-- form container -->
                <div class="support__form">

                    @if( $block->subtitle )
                        <!-- title -->
                        <h3 class="support__form-title">
                            {{ $block->subtitle }}
                        </h3>
                        <!-- title -->
                    @endif

                    @if( $block->excerpt )
                        <!-- excerpt -->
                        <div class="support__form-descr">
                            {{ $block->excerpt }}
                        </div>
                        <!-- end excerpt -->
                    @endif

                    @include( 'forms.support' )

                </div>
                <!-- form container -->

            </div>
            <!-- end content -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Text -->

@endif
