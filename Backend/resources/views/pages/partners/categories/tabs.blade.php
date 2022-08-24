<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('partners.categories.edit') ? 'active' : ''}}"
                href="{{route('partners.categories.edit', compact('categories'))}}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('partners.categories.seo') ? 'active' : ''}}"
                href="{{route('partners.categories.seo', $model)}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
