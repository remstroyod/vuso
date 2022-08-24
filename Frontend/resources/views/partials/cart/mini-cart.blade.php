<!-- Cart -->
<div class="cart">

    <!-- overlay -->
    <div class="cart__overlay"></div>
    <!-- end overlay -->

    <!-- container -->
    <div class="container">

        <!-- mobile -->
        <div class="cart__toggler-mobile">
            <span data-cart-total-price>{{ priceFormat($cartTotal) }}</span>
        </div>
        <!-- end mobile -->

        <!-- products -->
        <div class="cart__products">

            @php
                $products = Frontend\Models\Catalog\Product::get(['id', 'slug']);
            @endphp

            @foreach( $cartContent as $item )

                <!-- product -->
                <div class="cart__product">

                    <!-- label -->
                    <div class="cart__product-label">
                        <div class="cart__product-title">
                            {{ $item->name }}, {{ priceFormat($item->getPriceSumWithConditions()) }}
                        </div>
                        <div
                            class="cart__product-remove cartMiniRemoveProduct"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-cart-product-remove"
                            data-product-name="{{ $item->name }}"
                            data-product-id="{{ $item->id }}"
                        ></div>
                    </div>
                    <!-- end label -->

                    <!-- info -->
                    <div class="cart__product-info">

                        <!-- fullname -->
                        <!-- <div class="cart__product-head">
                            {{ auth()->user()->detail->fullname }}
                        </div> -->
                        <!-- end fullname -->

                        <!-- params -->
                        <div class="cart__product-params">

                            @if (isset($item->attributes->item_info))
                                @foreach( $item->attributes->item_info as $info )
                                    <div class="cart__product-param">
                                        <div class="param-title">
                                            {{ __( $info->name ) }}:
                                        </div>
                                        <div class="param-value">
                                            {{ $info->value }}
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <!-- <div class="cart__product-param">
                                <div class="param-title">
                                    Дата рождения:
                                </div>
                                <div class="param-value">
                                    31.11.1990
                                </div>
                            </div>
                            <div class="cart__product-param">
                                <div class="param-title">
                                    Выезд:
                                </div>
                                <div class="param-value">
                                    30.11.2002
                                </div>
                            </div>
                            <div class="cart__product-param">
                                <div class="param-title">
                                    Телефон:
                                </div>
                                <div class="param-value">
                                    0981234567
                                </div>
                            </div>
                            <div class="cart__product-param">
                                <div class="param-title">
                                    Паспорт:
                                </div>
                                <div class="param-value">
                                    №AB123456
                                </div>
                            </div>
                            <div class="cart__product-param">
                                <div class="param-title">
                                    Загранпаспорт:
                                </div>
                                <div class="param-value">
                                    №FF232098
                                </div>
                            </div> -->
                        </div>
                        <!-- <div class="cart__product-address">
                            <div class="address-title">
                                Регистрация:
                            </div>
                            <div class="address-value">
                                с. Ровеньки, Тернопольской Области
                            </div>
                        </div> -->
                        <div class="cart__product-controls">
                            <!-- TODO: styles -->
                            <a class="cart__product-edit" href="{{route('catalog.product.index', ['product' => $products->where('id', $item->attributes->id_product)->first()['slug'], 'state' => 'change', 'cartItemId' => $item->id])}}">
                                {{ __( 'Изменить' ) }}
                            </a>
                            <div
                                class="cart__product-remove-mobile cartMiniRemoveProduct"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-cart-product-remove"
                                data-product-name="{{ $item->name }}"
                                data-product-id="{{ $item->id }}"
                            >
                                <span>
                                    {{ __( 'Удалить' ) }}
                                </span>
                            </div>
                        </div>
                        <!-- end params -->

                    </div>
                    <!-- end info -->

                </div>
                <!-- end product -->

            @endforeach

        </div>
        <!-- end products -->

        <!-- wrapper -->
        <div class="cart__checkout-wrapper">

            <!-- TODO: styles -->
            <!-- checkout -->
            <a href="{{route('basket.index')}}" class="btn yellow cart__checkout">

                {{ __( 'Продолжить оформление' ) }} <i>,</i>&nbsp;<span data-cart-total-price>{{ priceFormat($cartTotal) }}</span>

                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.91748 19.3412C8.62803 19.0452 8.62803 18.5653 8.91748 18.2693L15.311 11.7316L8.91748 5.19378C8.62803 4.89781 8.62803 4.41793 8.91748 4.12196C9.20692 3.82598 9.67621 3.82598 9.96566 4.12196L16.8833 11.1956C17.1728 11.4916 17.1728 11.9715 16.8833 12.2675L9.96566 19.3412C9.67621 19.6371 9.20692 19.6371 8.91748 19.3412Z" fill="#151826"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.70299 19.5509C8.29952 19.1383 8.29952 18.4721 8.70299 18.0596L14.8914 11.7316L8.70299 5.40354C8.29952 4.99097 8.29952 4.32477 8.70299 3.91221C9.11011 3.4959 9.77302 3.4959 10.1801 3.91221L17.0978 10.9859C17.5013 11.3985 17.5013 12.0647 17.0978 12.4772L10.1801 19.5509C9.77302 19.9672 9.11011 19.9672 8.70299 19.5509ZM9.13196 18.4791C8.95653 18.6585 8.95653 18.952 9.13196 19.1314C9.30373 19.307 9.5794 19.307 9.75117 19.1314L16.6688 12.0577C16.8442 11.8783 16.8442 11.5848 16.6688 11.4054L9.75117 4.33171C9.5794 4.15606 9.30373 4.15606 9.13196 4.33171C8.95653 4.5111 8.95653 4.80465 9.13196 4.98403L15.5255 11.5218C15.6395 11.6384 15.6395 11.8247 15.5255 11.9413L9.13196 18.4791Z" fill="#151826"/>
                </svg>

            </a>
            <!-- end checkout -->

        </div>
        <!-- end wrapper -->

    </div>
    <!-- end container -->

</div>
<!-- End Cart -->
