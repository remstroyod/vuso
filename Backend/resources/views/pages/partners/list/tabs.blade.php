<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('partners.list.edit') ? 'active' : ''}}"
                href="{{route('partners.list.edit', compact('partners'))}}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('partners.list.seo') ? 'active' : ''}}"
                href="{{route('partners.list.seo', $model)}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
