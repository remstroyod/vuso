<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs($page->page . '.products.edit') ? 'active' : ''}}"
                href="{{route($page->page . '.products.edit', ['product' => $product])}}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    @if( request()->routeIs('catalog.*') )

        <li class="nav-item">
            <a
                    class="nav-link {{request()->routeIs('catalog.widget.edit') ? 'active' : ''}}"
                    href="{{route('catalog.widget.edit', ['product' => $product])}}"
            >
                {{ __( 'Widget' ) }}
            </a>
        </li>

        @if( L5Modular::enabled('EDocuments') )
            @permission('modules_edocuments_access')
                <li class="nav-item">
                    <a
                            class="nav-link {{request()->routeIs('catalog.edocuments.edit') ? 'active' : ''}}"
                            href="{{route('catalog.edocuments.edit', ['product' => $product])}}"
                    >
                        {{ __( 'E-Documents' ) }}
                    </a>
                </li>
            @endpermission
        @endif

    @endif

    @if( request()->routeIs('b2b.*') )

        <li class="nav-item">
            <a
                    class="nav-link {{request()->routeIs('b2b.products.builder') ? 'active' : ''}}"
                    href="{{route('b2b.products.builder', ['product' => $product])}}"
            >
                {{ __( 'Конструктор' ) }}
            </a>
        </li>

        <li class="nav-item">
            <a
                    class="nav-link @if( request()->routeIs('b2b.constructor.dinamyc.*') ) active @endif"
                    href="{{ route('b2b.constructor.dinamyc.index', ['product' => $product]) }}"
            >
                {{ __( 'Шорткоды' ) }}
            </a>
        </li>

        <li class="nav-item">
            <a
                    class="nav-link {{request()->routeIs($page->page . '.products.tags') ? 'active' : ''}}"
                    href="{{route($page->page . '.products.tags', ['product' => $product])}}"
            >
                {{ __( 'Тэги' ) }}
            </a>
        </li>
    @endif

    @permission('seo_access')
        <li class="nav-item">
            <a
                    class="nav-link {{request()->routeIs($page->page . '.products.seo') ? 'active' : ''}}"
                    href="{{route($page->page . '.products.seo', ['product' => $product])}}"
            >
                {{ __( 'SEO данные' ) }}
            </a>
        </li>
    @endpermission

</ul>
<!-- end nav -->
