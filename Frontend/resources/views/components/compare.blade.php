{{--Component: Сравнение страховых полисов :Component--}}
{{--Fields: title, content :Fields--}}
@if( $block )

    <!-- Compare -->
    <div class="category__compare">

        <!-- container -->
        <div class="container">

            @if( $block->title )
                <!-- title -->
                <div class="category__compare-title">
                    {{ $block->title }}
                </div>
                <!-- end title -->
            @endif

            @if( $block->content )
                {!! $block->content !!}
            @endif

        </div>
        <!-- end container -->

    </div>
    <!-- End Compare -->

@endif
