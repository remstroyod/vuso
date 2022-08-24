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

    <!-- descr -->
    <div class="product-card__descr">

        {!! \Illuminate\Support\Str::limit($item->description, 300) !!}

    </div>
    <!-- end descr -->

    <!-- footer -->
    <div class="product-card__controls">

        <button class="btn yellow product-card__order">
            {{ __( 'Оформить' ) }}
        </button>

        <a href="{{ isset($is_blocks) ? $item->link : route('catalog.product.index', $item) }}" class="product-card__details">
            {{ __( 'Детальнее' ) }}
        </a>

    </div>
    <!-- end footer -->

</div>
<!-- End Card -->
