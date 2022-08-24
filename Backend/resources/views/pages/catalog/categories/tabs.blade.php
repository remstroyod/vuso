<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{ (request()->routeIs('catalog.categories.edit') || request()->routeIs('b2b.categories.edit')) ? 'active' : '' }}"
                href="{{ request()->routeIs('catalog.categories.edit') ? route('catalog.categories.edit', ['category' => $category]) : route('b2b.categories.edit', ['category' => $category]) }}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('blocks.*') ) active @endif"
                href="{{ request()->routeIs('catalog.*') ? route('blocks.catalog.category.index', ['page' => 'catalog', 'category' => $category]) : route('blocks.catalog.category.index', ['page' => 'b2b', 'category' => $category]) }}"
        >
            {{ __( 'Блоки' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('attach.faq.catalog.*') ) active @endif"
                href="{{ request()->routeIs('catalog.*') ? route('attach.faq.catalog.category.form', ['page' => 'catalog', 'category' => $category]) : route('attach.faq.catalog.category.form', ['page' => 'b2b', 'category' => $category]) }}"
        >
            {{ __( 'Вопросы и ответы' ) }}
        </a>
    </li>

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{ (request()->routeIs('catalog.categories.seo') || request()->routeIs('b2b.categories.seo')) ? 'active' : '' }}"
                href="{{ request()->routeIs('catalog.categories.seo') ? route('catalog.categories.seo', ['category' => $category ]) : route('b2b.categories.seo', ['category' => $category ])}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
