<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('articles.edit') ? 'active' : ''}}"
                href="{{ route('articles.edit') }}"
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

    @permission('articles_access')
    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('articles.categories.*') ) active @endif"
                href="{{ route('articles.categories.index') }}"
        >
            {{ __( 'Категории' ) }}
        </a>
    </li>
    @endpermission

    @permission('articles_access')
    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('articles.list.*') ) active @endif"
                href="{{ route('articles.list.index') }}"
        >
            {{ __( 'Список' ) }}
        </a>
    </li>
    @endpermission

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('articles.seo') ? 'active' : ''}}"
                href="{{route('articles.seo', ['id' => 'edit'])}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
