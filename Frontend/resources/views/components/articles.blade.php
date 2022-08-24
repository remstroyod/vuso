{{--Component: Статьи :Component--}}
{{--Fields: title :Fields--}}
@if( $block )

{{--
<!-- Insurance -->
<section>
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
--}}

<div class="search-results__group search-results__group--interesting-articles">
    @if( $block->title )
        <h2 class="search-results__group-title">
            {{ $block->title }}
        </h2>
    @endif

    {{--
    @if( $block->excerpt )
        <div class="insurance__descr">
            {{ $block->excerpt }}
        </div>
    @endif
    --}}

    <ul class="search-results__group-list">
        @if( $block->elements->count() )
            @foreach( $block->elements as $item )
                <li>
                    @include( 'partials.loop.articles', [ 'item' => $item, 'is_blocks' => true ] )
                </li>
            @endforeach
        @else
            @php( $articles = Frontend\Models\Articles\Articles::popular(3)->get() )
            @if( $articles->count() )
                @foreach( $articles as $item )
                    @include( 'partials.loop.articles', [ 'item' => $item ] )
                @endforeach
            @endif
        @endif
    </ul>
</div>

{{--
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- End Insurance -->
--}}

@endif
