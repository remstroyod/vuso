<!-- nav -->
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('sales.categories.edit') ? 'active' : ''}}"
                href="{{route('sales.categories.edit', compact('categories'))}}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('sales.categories.seo') ? 'active' : ''}}"
                href="{{route('sales.categories.seo', $model)}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
