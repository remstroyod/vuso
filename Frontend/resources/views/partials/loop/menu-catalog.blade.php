<!-- card -->
<div class="header__insure-menu__card">

    @if ( Storage::disk('public')->exists('images/catalog/category/' . $category->image) )
        <!-- image -->
        <div class="header__insure-menu__card-image">
            <img
                    src="{{ Storage::url('images/catalog/category/' . $category->image) }}"
                    alt="{{ $category->name }}"
                    title="{{ $category->name }}"
            >
        </div>
        <!-- end image -->
    @endif

    <!-- info -->
    <div class="header__insure-menu__card-info">

        <!-- header -->
        <a href="{{ route('catalog.category.index', ['contragents' => $category->contragent, 'category' => $category]) }}" class="header__insure-menu__card-link">

            @if( $category->icon_image )

                @if ( Storage::disk('public')->exists('images/catalog/category/' . $category->icon_image) )
                    <span class="icon">
                        <img
                                src="{{ Storage::url('images/catalog/category/' . $category->icon_image) }}"
                                alt="{{ $category->name }}"
                                title="{{ $category->name }}"
                        >
                    </span>
                @endif

            @elseif( $category->icon_svg )

                <span class="icon">
                    {!! $category->icon_svg !!}
                </span>

            @endif

            <span class="text">
                {{ $category->short_name }}
            </span>

        </a>
        <!-- end header -->

        @php( $products = $category->products )
        @if( count($products) )

            <!-- toggler -->
            <div class="header__insure-menu__card-toggler">
                {{ __( 'Виды страхования' ) }}
            </div>
            <!-- end toggler -->

            <!-- toggler -->
            <div class="header__insure-menu__card-list">

                @foreach( $products as $product )

                    <a href="{{ route('catalog.product.index', $product) }}">
                        {{ $product->short_name }}
                    </a>

                @endforeach

            </div>
            <!-- end toggler -->

        @endif

    </div>
    <!-- end info -->

</div>
<!-- end card -->
