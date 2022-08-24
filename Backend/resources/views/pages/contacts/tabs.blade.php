<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('contacts.edit') ? 'active' : ''}}"
                href="{{ route('contacts.edit') }}"
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
                class="nav-link @if( request()->routeIs('contacts.offices.*') ) active @endif"
                href="{{ route('contacts.offices.index') }}"
        >
            {{ __( 'Представительства' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('contacts.countries.*') ) active @endif"
                href="{{ route('contacts.countries.index') }}"
        >
            {{ __( 'Города' ) }}
        </a>
    </li>

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('contacts.seo') ? 'active' : ''}}"
                href="{{route('contacts.seo', ['id' => 'edit'])}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- end nav -->
