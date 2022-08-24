{{--Component: CTA: Текст + Форма :Component--}}
{{--Fields: title, subtitle, excerpt, description :Fields--}}
@if( $block )

{{--
<!-- Section -->
<section class="">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- col -->
            <div class="col-12">
--}}

<div class="search-results__callback">
    <div class="search-results__callback-text">
        @if( $block->title )
            <h2 class="search-results__group-title">
                {{ $block->title }}
            </h2>
        @endif

        @if( $block->description )
            <div class="search-results__callback-descr">
                {!! $block->description !!}
            </div>
        @endif
    </div>
    <div class="search-results__callback-form">
        @if( $block->subtitle )
            <h3 class="search-results__callback-form__title">
                {{ $block->subtitle }}
            </h3>
        @endif
        @if( $block->excerpt )
            <div class="search-results__callback-form__descr">
                {!! $block->excerpt !!}
            </div>
        @endif
        @include( 'forms.search-component-form' )
    </div>
</div>

{{--
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- End Section -->
--}}

@endif
