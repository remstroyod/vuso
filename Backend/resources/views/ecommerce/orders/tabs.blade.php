<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('ecommerce.order.index') ? 'active' : ''}}"
                href="{{route('ecommerce.order.index')}}"
        >
            {{ __( 'Все заказы' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('ecommerce.order.edit') ? 'active' : ''}}"
                href="{{route('ecommerce.order.edit', ['order' => $model])}}"
        >
            {{ __( 'Детали заказа' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('ecommerce.order.history.index') ? 'active' : ''}}"
                href="{{route('ecommerce.order.history.index', $model)}}"
        >
            {{ __( 'История заказа' ) }}
        </a>
    </li>

</ul>
<!-- end nav -->
