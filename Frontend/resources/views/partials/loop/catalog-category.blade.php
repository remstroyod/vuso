<!-- Card -->
<div class="insurance__card">

    @php( $title = (isset($item->seo->h1)) ? $item->seo->h1 : $item->name )

    @if ( Storage::disk('public')->exists('images/catalog/category/' . $item->image) )
        <!-- image -->
        <div class="insurance__card__image">

            <img
                    src="{{ Storage::url('images/catalog/category/' . $item->image) }}"
                    alt="{{ $title }}"
                    title="{{ $title }}"
            >

        </div>
        <!-- end image -->
    @endif

    <!-- info -->
    <div class="insurance__card__info">

        <!-- title -->
        <div class="insurance__card__title">
            {{ $item->short_name }}
        </div>
        <!-- end title -->

        <!-- excerpt -->
        <div class="insurance__card__descr">
            {{ $item->excerpt }}
        </div>
        <!-- end excerpt -->

        <!-- control -->
        <div class="insurance__card__control">

            <!-- link -->
            <a href="{{ route('catalog.category.index', ['contragents' => $item->contragent, 'category' => $item]) }}" class="insurance__card__link">

                @if( $item->icon_image )

                    @if ( Storage::disk('public')->exists('images/catalog/category/' . $item->icon_image) )
                        <span class="icon">
                            <img
                                    src="{{ Storage::url('images/catalog/category/' . $item->icon_image) }}"
                                    alt="{{ $item->name }}"
                                    title="{{ $item->name }}"
                            >
                        </span>
                    @endif

                @elseif( $item->icon_svg )

                    <span class="icon">
                        {!! $item->icon_svg !!}
                    </span>

                @endif

                <span class="text">
                    {{ $item->name }}
                </span>

            </a>
            <!-- end link -->

        </div>
        <!-- end control -->

    </div>
    <!-- end info -->

</div>
<!-- End Card -->
