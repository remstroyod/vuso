<ul class="nav nav-tabs">
    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('faq.categories.edit') ? 'active' : ''}}"
                href="{{route('faq.categories.edit', compact('categories'))}}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

</ul>
