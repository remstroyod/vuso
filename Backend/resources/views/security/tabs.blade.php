<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('security.roles.index') ? 'active' : ''}}"
                href="{{ route('security.roles.index') }}"
        >
            {{ __( 'Роли' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('security.permission.index') ? 'active' : ''}}"
                href="{{ route('security.permission.index') }}"
        >
            {{ __( 'Права' ) }}
        </a>
    </li>

</ul>
<!-- end nav -->
