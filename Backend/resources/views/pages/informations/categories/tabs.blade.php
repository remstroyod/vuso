<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('informations.categories.edit') ? 'active' : ''}}"
                href="{{route('informations.categories.edit', compact('categories'))}}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('informations.categories.seo') ? 'active' : ''}}"
                href="{{route('informations.categories.seo', $model)}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
