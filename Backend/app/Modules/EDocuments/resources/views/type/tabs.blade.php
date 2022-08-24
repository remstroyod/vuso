<!-- nav -->
<ul class="nav nav-tabs">

    <li class="nav-item">
        <a
                class="nav-link {{request()->routeIs('edocuments.type.edit') ? 'active' : ''}}"
                href="{{ ($model->id) ? route('edocuments.type.edit', $model) : route('edocuments.type.create') }}"
        >
            {{ __( 'Основное' ) }}
        </a>
    </li>

</ul>
<!-- end nav -->
