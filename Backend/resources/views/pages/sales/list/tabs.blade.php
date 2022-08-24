<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('sales.list.edit') ? 'active' : ''}}"
                href="{{route('sales.list.edit', compact('sales'))}}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('sales.list.seo') ? 'active' : ''}}"
                href="{{route('sales.list.seo', ['sales' => $sales, 'model' => $sales])}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
