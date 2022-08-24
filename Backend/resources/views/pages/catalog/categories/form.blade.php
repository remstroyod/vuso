@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'catalog' => [
                'title'     => request()->routeIs('catalog.categories.*') ? __( 'Каталог' ) : __( 'Каталог B2B' ),
                'url'       => request()->routeIs('catalog.categories.*') ? route('catalog.edit') : route('b2b.edit'),
                'active'    => false
            ],
            'catalog-categories' => [
                'title'     => __( 'Категории' ),
                'url'       => request()->routeIs('catalog.categories.*') ? route('catalog.categories.index') : route('b2b.categories.index'),
                'active'    => false
            ],
            'catalog-categories-form' => [
                'title'     => $title,
                'url'       => '',
                'active'    => true
            ]
        ]
    ])

    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12 grid-margin ">

            <!-- Title -->
            <h4 class="card-title">
                {{ $title }}
            </h4>
            <!-- End Title -->

            @include('template-parts.message')

            @includeWhen($model->id, 'pages.catalog.categories.tabs', ['category' => $model])

            <!-- Form -->
            <form action="{{ request()->routeIs('catalog.categories.*') ? route(($model->id ? 'catalog.categories.update' : 'catalog.categories.store'), $model) : route(($model->id ? 'b2b.categories.update' : 'b2b.categories.store'), $model) }}" method="post" enctype="multipart/form-data">
                @csrf

                {!! html_hidden('type', $type) !!}

                <!-- Row -->
                <div class="row">

                    <!-- Col -->
                    <div class="col-lg-8 grid-margin stretch-card">

                        <!-- card -->
                        <div class="card">

                            <!-- card-body -->
                            <div class="card-body">

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Основное' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- row -->
                                <div class="row">

                                    <!-- Col -->
                                    <div class="col-lg-7">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __( 'Полное наименование' ) }}
                                            </label>
                                            {!! html_input('text', 'name', $model->name, ['class' => 'form-control', 'id' => 'name']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-lg-5">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="short_name">
                                                {{ __( 'Краткое наименование' ) }}
                                            </label>
                                            {!! html_input('text', 'short_name', $model->short_name, ['class' => 'form-control', 'id' => 'short_name']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                </div>
                                <!-- end row -->

                                <!-- row -->
                                <div class="row">

                                    <!-- col -->
                                    <div class="col-7">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="category_type_id">
                                                {{ __( 'Контрагент' ) }}
                                            </label>
                                            {!! html_select('category_type_id', $model->category_type_id, list_data($contragents), ['class' => 'custom-select', 'id' => 'category_type_id']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-5">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="category">
                                                {{ __( 'Категория' ) }}
                                            </label>
                                            {!! html_select('parent_id', $model->parent_id, ['' => 'Без категории'] + list_data($categories), ['class' => 'custom-select', 'id' => 'parent_id']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end row -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="excerpt">
                                        {{ __( 'Отрывок' ) }}
                                    </label>
                                    {!! html_textarea('excerpt', ($model->excerpt) ?? '', ['class' => 'form-control', 'id'=>'excerpt', 'rows' => 7]) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="description">
                                        {{ __( 'Текст' ) }}
                                    </label>
                                    {!! html_textarea('description', ($model->description) ?? '', ['class' => 'form-control custom-editor redactorTinymce', 'id' => 'description']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        {!! html_hidden('is_active', 0) !!}
                                        {!! html_checkbox('is_active', ($model->id) ? $model->is_active : 1, ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Активный' ) }}
                                        <i class="input-frame"></i> </label>
                                </div>
                                <!-- end form group -->

                                <!-- fieldset -->
                                <fieldset>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>
                                </fieldset>
                                <!-- end fieldset -->

                            </div>
                            <!-- end card-body -->

                        </div>
                        <!-- end card -->

                    </div>
                    <!-- End Col -->

                    <!-- Col -->
                    <div class="col-lg-4 grid-margin stretch-card">

                        <!-- card -->
                        <div class="card">

                            <!-- card-body -->
                            <div class="card-body">

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Прочее' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- form group -->
                                <div class="form-group mb-3">
                                    <!-- form group -->
                                    <div class="form-group">
                                        <label for="slug">
                                            {{ __( 'URL (формируется автоматически)' ) }}
                                        </label>
                                        {!! html_input('text', 'slug', $model->slug, ['class' => 'form-control', 'id' => 'slug']) !!}
                                    </div>
                                    <!-- end form group -->

                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group mb-5">
                                    <label for="order">
                                        {{ __( 'Позиция' ) }}
                                    </label>
                                    {!! html_input('text', 'order', (isset($model->order)) ? $model->order : '', ['class' => 'form-control', 'id' => 'order']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Изображение' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- Margin -->
                                <div class="mb-5">

                                    <!-- Image -->
                                    <p class="card-description">
                                        {{ __( 'Изображение' ) }}
                                    </p>
                                    <input
                                            type="file"
                                            id="imageUpload"
                                            name="image"
                                            class="border"
                                            data-max-file-size="3M"
                                            data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                                            data-default-file="{{ isset($model->image) ? url('storage' . '/images/catalog/category/' . $model->image) : '' }}"
                                    />
                                    <!-- End Image -->

                                </div>
                                <!-- End Margin -->

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Иконка' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- Margin -->
                                <div class="mb-3">

                                    <!-- Image -->
                                    <p class="card-description">
                                        {{ __( 'Изображение иконки' ) }}
                                    </p>
                                    <input
                                            type="file"
                                            id="iconUpload"
                                            name="icon_image"
                                            class="border"
                                            data-max-file-size="3M"
                                            data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                                            data-default-file="{{ isset($model->icon_image) ? url('storage' . '/images/catalog/category/' . $model->icon_image) : '' }}"
                                    />
                                    <!-- End Image -->

                                </div>
                                <!-- End Margin -->

                                <!-- Margin -->
                                <div class="mb-5">

                                    <!-- form group -->
                                    <div class="form-group">
                                        <label for="icon_svg">
                                            {{ __( 'Код SVG иконки' ) }}
                                        </label>
                                        {!! html_textarea('icon_svg', ($model->icon_svg) ?? '', ['class' => 'form-control', 'id'=>'icon_svg', 'rows' => 7]) !!}
                                    </div>
                                    <!-- end form group -->

                                </div>
                                <!-- End Margin -->

                                <!-- Title -->
                                <h4 class="card-title">
                                    {{ __( 'Настройки' ) }}
                                </h4>
                                <!-- End Title -->

                                <!-- form group -->
                                <div class="form-check form-check-flat form-check-primary mb-4">

                                    <label class="form-check-label">
                                        {!! html_hidden('is_header', 0) !!}
                                        {!! html_checkbox('is_header', $model->is_header, ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Header' ) }}
                                        <i class="input-frame"></i>
                                    </label>

                                    <!-- description -->
                                    <p class="card-description">
                                        {{ __( 'Снимите галочку, если Вы хотите отключить Header на этой странице' ) }}
                                    </p>
                                    <!-- end description -->

                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-check form-check-flat form-check-primary mb-4">

                                    <label class="form-check-label">
                                        {!! html_hidden('is_footer', 0) !!}
                                        {!! html_checkbox('is_footer', $model->is_footer, ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Footer' ) }}
                                        <i class="input-frame"></i>
                                    </label>

                                    <!-- description -->
                                    <p class="card-description">
                                        {{ __( 'Снимите галочку, если Вы хотите отключить Footer на этой странице' ) }}
                                    </p>
                                    <!-- end description -->

                                </div>
                                <!-- end form group -->

                            </div>
                            <!-- end card-body -->

                        </div>
                        <!-- end card -->

                    </div>
                    <!-- End Col -->

                </div>
                <!-- End Row -->

            </form>
            <!-- End Form -->

            @include( 'template-parts.editor' )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
