<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        @if( request()->routeIs('blocks.default.edit') || request()->routeIs('blocks.default.elements.index') )
            <a
                    class="nav-link {{request()->routeIs('blocks.default.edit') ? 'active' : ''}}"
                    href="{{ route('blocks.default.edit', ['page' => $page, 'block' => $block]) }}"
            >
                {{ __( 'Основное' ) }}
            </a>
        @elseif( request()->routeIs('blocks.static.edit') || request()->routeIs('blocks.static.elements.index') )
            <a
                    class="nav-link {{request()->routeIs('blocks.static.edit') ? 'active' : ''}}"
                    href="{{ route('blocks.static.edit', ['page' => $page, 'block' => $block]) }}"
            >
                {{ __( 'Основное' ) }}
            </a>
        @elseif( request()->routeIs('blocks.catalog.category.edit') || request()->routeIs('blocks.catalog.category.elements.index') )
            <a
                    class="nav-link {{request()->routeIs('blocks.catalog.category.edit') ? 'active' : ''}}"
                    href="{{ route('blocks.catalog.category.edit', ['page' => $page, 'category' => $category, 'block' => $block]) }}"
            >
                {{ __( 'Основное' ) }}
            </a>
        @endif
    </li>

    <li class="nav-item">
        @if( request()->routeIs('blocks.default.edit') || request()->routeIs('blocks.default.elements.index') )
            <a
                    class="nav-link @if( request()->routeIs('blocks.default.elements.*') ) ) active @endif"
                    href="{{ route('blocks.default.elements.index', ['page' => $page, 'block' => $block]) }}"
            >
                {{ __( 'Элементы' ) }}
            </a>
        @elseif( request()->routeIs('blocks.static.edit') || request()->routeIs('blocks.static.elements.index') )
            <a
                    class="nav-link @if( request()->routeIs('blocks.static.elements.*') ) ) active @endif"
                    href="{{ route('blocks.static.elements.index', ['page' => $page, 'block' => $block]) }}"
            >
                {{ __( 'Элементы' ) }}
            </a>
        @elseif( request()->routeIs('blocks.catalog.category.edit') || request()->routeIs('blocks.catalog.category.elements.index') )
            <a
                    class="nav-link @if( request()->routeIs('blocks.catalog.category.elements.*') ) ) active @endif"
                    href="{{ route('blocks.catalog.category.elements.index', ['page' => $page, 'category' => $category, 'block' => $block]) }}"
            >
                {{ __( 'Элементы' ) }}
            </a>
        @endif
    </li>

</ul>
<!-- end nav -->
