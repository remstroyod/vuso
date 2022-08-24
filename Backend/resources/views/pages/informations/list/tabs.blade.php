<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('informations.list.edit') ? 'active' : ''}}"
                href="{{route('informations.list.edit', compact('informations'))}}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('informations.list.seo') ? 'active' : ''}}"
                href="{{route('informations.list.seo', $model)}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
