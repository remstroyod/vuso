@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'catalog' => [
                'title'     => request()->routeIs('catalog.*') ? __( 'Каталог' ) : __( 'Каталог B2B' ),
                'url'       => route($page->page . '.edit'),
                'active'    => false
            ],
            'catalog-products' => [
                'title'     => __( 'Продукты' ),
                'url'       => route($page->page . '.products.index'),
                'active'    => false
            ],
            'catalog-products-form' => [
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

            @includeWhen($model->id, 'pages.catalog.products.tabs', ['product' => $model])

            <!-- Form -->
            <form
                    action="{{ request()->routeIs('catalog.*') ? route(($model->id ? 'catalog.products.update' : 'catalog.products.store'), $model) : route(($model->id ? 'b2b.products.update' : 'b2b.products.store'), $model) }}"
                    method="post"
                    enctype="multipart/form-data"
            >
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

                                <!-- Row -->
                                <div class="row">

                                    <!-- Col -->
                                    <div class="col-lg-8">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __( 'Наименование' ) }}
                                            </label>
                                            {!! html_input('text', 'name', $model->name, ['class' => 'form-control', 'id' => 'name']) !!}
                                            @error('name')
                                            <div class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-lg-4">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="short_name">
                                                {{ __( 'Короткое наименование' ) }}
                                            </label>
                                            {!! html_input('text', 'short_name', $model->short_name, ['class' => 'form-control', 'id' => 'short_name']) !!}
                                            @error('short_name')
                                            <div class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                </div>

                                <div class="row">
                                    <div class="col-lg-8">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __( '1С Наименование' ) }}
                                            </label>
                                            {!! html_input('text', 'doc_name_1c', $model->doc_name_1c, ['class' => 'form-control', 'id' => 'doc_name_1c']) !!}
                                            @error('doc_name_1c')
                                            <div class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <div class="col-lg-4">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __( '1С Идентификатор' ) }}
                                            </label>
                                            {!! html_input('text', 'doc_id_1c', $model->doc_id_1c, ['class' => 'form-control', 'id' => 'doc_id_1c']) !!}
                                            @error('doc_id_1c')
                                            <div class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                </div>
                                <!-- End Row -->

                                <!-- form group -->
                                <div class="form-group">

                                    <label for="category">
                                        {{ __( 'Категории' ) }}
                                    </label>
                                    {!! html_select('category[]', $model->categories->map->id->toArray(), list_data($categories), ['class' => 'js-example-basic-multiple w-100', 'multiple' => 'multiple', 'id' => 'category']) !!}
                                    @error('category')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                    @enderror
                                </div>
                                <!-- end form group -->

                                @if( request()->routeIs(['catalog.products.create', 'catalog.products.edit']) )
                                    <!-- form group -->
                                    <div class="form-group">

                                        <label for="relevant">
                                            {{ __( 'Покупают вместе' ) }}
                                        </label>
                                        {!! html_select('relevant[]', $model->relevant->map->id->toArray(), list_data($products), ['class' => 'js-example-basic-multiple w-100', 'multiple' => 'multiple', 'id' => 'relevant']) !!}
                                        @error('relevant')
                                        <div class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <!-- end form group -->
                                @endif

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="excerpt">
                                        {{ __( 'Отрывок' ) }}
                                    </label>
                                    {!! html_textarea('excerpt', ($model->excerpt) ?? '', ['class' => 'form-control', 'id' => 'excerpt', 'rows' => 8]) !!}
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
                                        @if( $model->slug )
                                            @php( $full_url = $model->getFullUrl() )
                                            <p class="card-description pt-1">
                                                <small><a href="{{ $full_url }}" target="_blank">{{ $full_url }}</a></small>
                                            </p>
                                        @endif
                                    </div>
                                    <!-- end form group -->

                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group mb-3">
                                    <label for="order">
                                        {{ __( 'Позиция' ) }}
                                    </label>
                                    {!! html_input('text', 'order', (isset($model->order)) ? $model->order : '', ['class' => 'form-control', 'id' => 'order']) !!}
                                </div>
                                <!-- end form group -->

                                @if( request()->routeIs('catalog.products.*') )

                                    <!-- form group -->
                                    <div class="form-group mb-5">
                                        <label for="payhub_id">
                                            {{ __( 'Система оплаты' ) }}
                                        </label>
                                        {!! html_select('payhub_id', $model->payhub_id, list_data($payhub), ['class' => 'custom-select', 'id' => 'payhub_id']) !!}
                                    </div>
                                    <!-- end form group -->

                                @endif

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Изображение' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- Margin -->
                                <div class="mb-3">

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
                                            data-default-file="{{ isset($model->image) ? url('storage' . '/images/catalog/products/' . $model->image) : '' }}"
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
                                        {!! html_textarea('icon_svg', ($model->icon_svg) ?? '', ['class' => 'form-control', 'id' => 'icon_svg', 'rows' => 10]) !!}
                                        @error('icon_svg')
                                        <div class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <!-- end form group -->

                                </div>
                                <!-- End Margin -->

                                <!-- Title -->
                                <h4 class="card-title">
                                    {{ __( 'Настройки' ) }}
                                </h4>
                                <!-- End Title -->

                                @if( request()->routeIs(['catalog.products.create', 'catalog.products.edit']) )
                                    <!-- form group -->
                                    <div class="form-group mb-4">
                                        <label for="token">
                                            {{ __( 'Token' ) }}
                                        </label>
                                        {!! html_input('text', 'token', $model->token, ['class' => 'form-control', 'id' => 'token']) !!}
                                        @error('token')
                                        <div class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                    <!-- end form group -->
                                @endif

                                <!-- form group -->
                                <div class="form-check form-check-flat form-check-primary mb-4">

                                    <label class="form-check-label">
                                        {!! html_hidden('is_popular', 0) !!}
                                        {!! html_checkbox('is_popular', $model->is_popular, ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Популярный' ) }}
                                        <i class="input-frame"></i>
                                    </label>

                                    <!-- description -->
                                    <p class="card-description">
                                        {{ __( 'Отметить этот продукт как популярный.' ) }}
                                    </p>
                                    <!-- end description -->

                                </div>
                                <!-- end form group -->

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
