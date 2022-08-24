<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('sales.edit') ? 'active' : ''}}"
                href="{{ route('sales.edit') }}"
        >
            {{ __( 'Основное' ) }}
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
                class="nav-link @if( request()->routeIs('sales.categories.*') ) active @endif"
                href="{{ route('sales.categories.index') }}"
        >
            {{ __( 'Категории' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('sales.list.*') ) active @endif"
                href="{{ route('sales.list.index') }}"
        >
            {{ __( 'Список' ) }}
        </a>
    </li>

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('sales.seo') ? 'active' : ''}}"
                href="{{route('sales.seo', ['id' => 'edit'])}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
