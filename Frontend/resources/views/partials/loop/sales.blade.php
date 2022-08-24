<!-- card -->
<div class="card">

    @php( $title = (isset($item->seo->h1)) ? $item->seo->h1 : $item->name )

    @if ( Storage::disk('public')->exists('images/sales/' . $item->image) )
        <!-- Picture -->
        <img
                src="{{ Storage::url('images/sales/' . $item->image) }}"
                class="card-img-top"
                alt="{{ $title }}"
                title="{{ $title }}"
        >
        <!-- End Picture -->
    @endif

    <!-- body -->
    <div class="card-body">

        <!-- title -->
        <h5 class="card-title">
            {{ $title }}
        </h5>

        <!-- footer -->
        <div class="card-footer">

            <a href="{{ route('sales.show', [$item]) }}" class="card-link">
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
    <!-- end body -->

</div>
<!-- end card -->
