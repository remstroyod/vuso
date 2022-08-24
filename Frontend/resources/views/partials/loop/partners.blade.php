<!-- item -->
<div class="partners__item">

    <!-- text -->
    <div class="partners__item-text">

        @php( $tags = $item->tags )
        @if( $tags->count() )
            <!-- labels -->
            <div class="partners__item-labels">

                @foreach( $tags as $tag )
                    <!-- label -->
                    <div class="partners__item-label">
                        {{ $tag->name }}
                    </div>
                    <!-- end label -->
                @endforeach

            </div>
            <!-- end labels -->
        @endif

        <!-- quote -->
        <blockquote class="partners__item-quote">
            {!! $item->excerpt !!}
        </blockquote>
        <!-- end quote -->

    </div>
    <!-- end text -->

    @if( $item->image )
        @if ( Storage::disk('public')->exists('images/partners/' . $item->image) )
            <!-- logo -->
            <div class="partners__item-logo">
                <img
                        src="{{ Storage::url('images/partners/' . $item->image) }}"
                        alt="{{ $item->name }}"
                        title="{{ $item->name }}"
                >
            </div>
            <!-- end logo -->
        @endif
    @endif

</div>
<!-- end item -->
