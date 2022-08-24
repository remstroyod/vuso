@php( $title = (isset($item->seo->h1)) ? $item->seo->h1 : $item->name )

<!-- Card -->
<div class="card @isset( $class ) {{ $class }} @endisset">

    @if( isset( $is_blocks ) )

        @if ( Storage::disk('public')->exists('images/blocks/elements/' . $item->image) )
            <!-- Picture -->
            <img
                    src="{{ Storage::url('images/blocks/elements/' . $item->image) }}"
                    class="card-img-top"
                    alt="{{ $item->title }}"
                    title="{{ $item->title }}"
            >
            <!-- End Picture -->
        @endif

    @else

        @if ( Storage::disk('public')->exists('images/articles/' . $item->image) )
            <!-- Picture -->
            <img
                    src="{{ Storage::url('images/articles/' . $item->image) }}"
                    class="card-img-top"
                    alt="{{ $title }}"
                    title="{{ $title }}"
            >
            <!-- End Picture -->
        @endif

    @endif

    <!-- Body -->
    <div class="card-body">

        <!-- title -->
        <h5 class="card-title">

            @if( isset( $is_blocks ) )

                {{ $item->title }}

            @else

                {{ $title }}

            @endif

        </h5>
        <!-- end title -->

        <!-- footer -->
        <div class="card-footer">

            <a href="{{ isset($is_blocks) ? $item->link : route('news.show', [$item->category, $item]) }}" class="card-link">
                {{ __( 'Читать полностью' ) }}
            </a>

            <!-- date -->
            <div class="card-date">
                {{ Date::parse($item->published_at)->format('j F Y') }}
            </div>
            <!-- end date -->

        </div>
        <!-- end footer -->

    </div>
    <!-- End Body -->

</div>
<!-- End Card -->
