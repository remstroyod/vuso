<!-- Card -->
<div class="product-card">

    <!-- category -->
    <div class="product-card__category">
        {{ $item->getCategory()->name }}
    </div>
    <!-- end category -->

    <!-- title -->
    <div class="product-card__title">
        @if( $item->short_name )
            {{ $item->short_name }}
        @else
            {{ $item->name }}
        @endif
    </div>
    <!-- end title -->

    <!-- excerpt -->
    <div class="product-card__descr">
        {!! $item->excerpt !!}
    </div>
    <!-- end excerpt -->

    <!-- controls -->
    <div class="product-card__controls">

        <a href="{{ route('b2b.product.index', ['product' => $item, 'category' => $item->getCategory()]) }}" class="product-card__link">
            {{ __( 'Перейти' ) }}
        </a>

    </div>
    <!-- end controls -->

</div>
<!-- End Card -->
