<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('informations.edit') ? 'active' : ''}}"
                href="{{ route('informations.edit') }}"
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
                class="nav-link @if( request()->routeIs('informations.categories.*') ) active @endif"
                href="{{ route('informations.categories.index') }}"
        >
            {{ __( 'Категории' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('informations.list.*') ) active @endif"
                href="{{ route('informations.list.index') }}"
        >
            {{ __( 'Список' ) }}
        </a>
    </li>

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('informations.seo') ? 'active' : ''}}"
                href="{{route('informations.seo', ['id' => 'edit'])}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
