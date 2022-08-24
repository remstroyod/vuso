<ul class="nav nav-tabs">
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('faq.list.edit') ? 'active' : ''}}"
                href="{{route('faq.list.edit', compact('faq'))}}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

</ul>
