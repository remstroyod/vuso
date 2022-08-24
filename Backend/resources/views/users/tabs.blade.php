<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('users.list.*') ? 'active' : ''}}"
                href="{{ (isset($user)) ? route('users.list.edit', $user) : route('users.list.create') }}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

</ul>
<!-- end nav -->
