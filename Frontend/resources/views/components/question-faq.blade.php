{{--Component: Задать вопрос :Component--}}
{{--Fields: title :Fields--}}
@if( $block )

    <!-- faq -->
    <section class="faq">

        <!-- container -->
        <div class="container">

        @isset( $page->faqs )

            @if( $page->faqs->count() )

                @include( 'partials.accordion.faq.catalog', ['class' => 'faq__accordion'] )

            @endif

        @endisset

            <!-- form -->
            <div class="faq__form">

                @if( $block->title )
                    <!-- title -->
                    <h3 class="faq__form-title">
                        {{ $block->title }}
                    </h3>
                    <!-- end title -->
                @endif

                @include( 'forms.catalog-faq' )

            </div>
            <!-- end form -->

        </div>
        <!-- end container -->

    </section>
    <!-- end faq -->

@endif
