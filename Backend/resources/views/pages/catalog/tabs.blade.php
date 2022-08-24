<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{ (request()->routeIs('catalog.edit') || request()->routeIs('b2b.edit')) ? 'active' : '' }}"
                href="{{ request()->routeIs('catalog.edit') ? route('catalog.edit') : route('b2b.edit') }}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('blocks.default.*') ) active @endif"
                href="{{ route('blocks.default.index', ['page' => $model]) }}"
        >
            {{ __( 'Блоки' ) }}
        </a>
    </li>

    @permission('catalog_access')
    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('catalog.contragents.*') || request()->routeIs('b2b.contragents.*') ) active @endif"
                href="{{ (request()->routeIs('catalog.edit')) ? route('catalog.contragents.index') : route('b2b.contragents.index') }}"
        >
            {{ __( 'Контрагенты' ) }}
        </a>
    </li>
    @endpermission

    @permission('catalog_access')
    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('catalog.categories.*') || request()->routeIs('b2b.categories.*') ) active @endif"
                href="{{ (request()->routeIs('catalog.*')) ? route('catalog.categories.index') : route('b2b.categories.index') }}"
        >
            {{ __( 'Категории' ) }}
        </a>
    </li>
    @endpermission

    @permission('catalog_access')
    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('attach.faq.*') ) active @endif"
                href="{{ route('attach.faq.form', ['page' => $model]) }}"
        >
            {{ __( 'Вопросы и ответы' ) }}
        </a>
    </li>
    @endpermission

    @permission('catalog_access')
    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('catalog.products.*') || request()->routeIs('b2b.products.*') ) active @endif"
                href="{{ (request()->routeIs('catalog.edit')) ? route('catalog.products.index') : route('b2b.products.index') }}"
        >
            {{ __( 'Продукты' ) }}
        </a>
    </li>
    @endpermission

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{ (request()->routeIs('catalog.seo') || request()->routeIs('b2b.seo')) ? 'active' : ''}}"
                href="{{ (request()->routeIs('catalog.edit')) ? route('catalog.seo', ['id' => 'edit']) : route('b2b.seo', ['id' => 'edit'])}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
