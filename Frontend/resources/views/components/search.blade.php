{{--Component: Также ищут :Component--}}
{{--Fields: title :Fields--}}
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

<!-- results -->
<div class="search-results__group search-results__group--related-search">
    @if( $block->title )
        <h2 class="search-results__group-title">
            {{ $block->title }}
        </h2>
    @endif
    @if( $block->elements->count() )
        <ul class="search-results__group-list search-results__group-list--links">
            @foreach( $block->elements as $item )
                <li>
                    <a href="{{ $item->link }}" class="search-results__group-link">
                        {{ $item->linktext }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
<!-- end results -->

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
