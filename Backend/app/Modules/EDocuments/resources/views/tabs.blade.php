<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{ (request()->routeIs('edocuments.edit') || request()->routeIs('edocuments.create')) ? 'active' : ''}}"
                href="{{ ($model->id) ? route('edocuments.edit', $model) : route('edocuments.create') }}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

    <li class="nav-item">
        <a
                class="nav-link {{ (request()->routeIs('edocuments.images.index') || request()->routeIs('edocuments.images.edit')) ? 'active' : ''}}"
                href="{{ route('edocuments.images.index', $model) }}"
        >
            {{ __( 'Изображения' ) }}
        </a>
    </li>

</ul>
<!-- end nav -->
