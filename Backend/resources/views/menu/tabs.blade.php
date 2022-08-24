<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('menu.edit') ? 'active' : ''}}"
                href="{{ route('menu.edit', $model) }}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    @permission('menu_access')
    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('menu.elements.*') ) ) active @endif"
                href="{{ route('menu.elements.index', ['menu' => $model]) }}"
        >
            {{ __( 'Элементы' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
