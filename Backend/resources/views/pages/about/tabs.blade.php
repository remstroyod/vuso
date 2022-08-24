<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('about.edit') ? 'active' : ''}}"
                href="{{ route('about.edit') }}"
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

    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('attach.faq.*') ) active @endif"
                href="{{ route('attach.faq.form', ['page' => $model]) }}"
        >
            {{ __( 'Вопросы и ответы' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('about.history.*') ) ) active @endif"
                href="{{ route('about.history.index') }}"
        >
            {{ __( 'История' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('about.team.*') ) active @endif"
                href="{{ route('about.team.index') }}"
        >
            {{ __( 'Команда' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('about.awards.*') ) active @endif"
                href="{{ route('about.awards.index') }}"
        >
            {{ __( 'Награды' ) }}
        </a>
    </li>

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('about.seo') ? 'active' : ''}}"
                href="{{route('about.seo', ['id' => 'edit'])}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
