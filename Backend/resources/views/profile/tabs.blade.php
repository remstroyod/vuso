<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link"
                href="{{ route('users.profile.index') }}"
        >
            {{ __( 'Главная' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('users.profile.edit') ? 'active' : ''}}"
                href="{{ route('users.profile.edit') }}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('users.profile.password') ? 'active' : ''}}"
                href="{{ route('users.profile.password') }}"
        >
            {{ __( 'Сменить пароль' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('users.profile.socials.*') ) ) active @endif"
                href="{{ route('users.profile.socials.index') }}"
        >
            {{ __( 'Соц. сети' ) }}
        </a>
    </li>

</ul>
<!-- end nav -->
