<!-- Card -->
<div class="product-card">

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

        {!! $item->description !!}

    </div>
    <!-- end excerpt -->

    <!-- controls -->
    <div class="product-card__controls">

        <a class="btn yellow product-card__order" href="{{ route('catalog.product.index', $item) }}">
            {{ __( 'Оформить' ) }}
        </a>

        <a class="product-card__details" href="{{ route('catalog.product.index', $item) }}">
            {{ __( 'Детальнее' ) }}
        </a>

    </div>
    <!-- end controls -->

</div>
<!-- End Card -->
