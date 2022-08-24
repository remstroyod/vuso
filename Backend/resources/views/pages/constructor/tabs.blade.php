<!-- Nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('constructor.edit') ? 'active' : ''}}"
                href="{{ route('constructor.edit', $model) }}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('constructor.show') ? 'active' : ''}}"
                href="{{route('constructor.show', $model)}}"
        >
            {{ __( 'Конструктор' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link @if( request()->routeIs('constructor.dinamyc.*') ) active @endif"
                href="{{ route('constructor.dinamyc.index', ['pages' => $model]) }}"
        >
            {{ __( 'Шорткоды' ) }}
        </a>
    </li>

    @permission('seo_access')
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('constructor.seo') ? 'active' : ''}}"
                href="{{route('constructor.seo', ['pages' => $model, 'id' => 'edit'])}}"
        >
            {{ __( 'SEO данные' ) }}
        </a>
    </li>
    @endpermission

</ul>
<!-- End Nav -->
