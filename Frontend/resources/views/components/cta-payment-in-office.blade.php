{{--Component: CTA: Оплата в офисе :Component--}}
{{--Fields: title :Fields--}}
@if( $block )

    <!-- request -->
    <div class="info-text__payment-request">

        @if( $block->title )
            <!-- title -->
            <div class="info-text__payment-request__title">
                {{ $block->title }}
            </div>
            <!-- end title -->
        @endif

        @include( 'forms.book-time' )

    </div>
    <!-- end request -->

@endif
