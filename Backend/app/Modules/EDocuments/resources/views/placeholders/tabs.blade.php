<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{ (request()->routeIs('edocuments.placeholders.edit') || request()->routeIs('edocuments.placeholders.create')) ? 'active' : ''}}"
                href="{{ ($model->id) ? route('edocuments.placeholders.edit', $model) : route('edocuments.placeholders.create') }}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

</ul>
<!-- end nav -->
