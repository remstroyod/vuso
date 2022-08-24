@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'articles' => [
                'title'     => __( 'Новости и статьи' ),
                'url'       => route('articles.edit'),
                'active'    => false
            ],
            'articles-list' => [
                'title'     => __( 'Список' ),
                'url'       => route('articles.list.index'),
                'active'    => false
            ],
            'articles-list-form' => [
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

            @includeWhen($model->id, 'pages.articles.list.tabs', ['articles' => $model])

            <!-- Form -->
            <form action="{{ route(($model->id ? 'articles.list.update' : 'articles.list.store'), $model) }}" method="post" enctype="multipart/form-data">
            @csrf

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

                                    <!-- col -->
                                    <div class="col-lg-8">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __( 'Наименование' ) }}
                                            </label>
                                            {!! html_input('text', 'name', $model->name, ['class' => 'form-control', 'id' => 'name']) !!}
                                            <p class="card-description pt-1">
                                                <small>{{ __( 'Пропишите полное наименование статьи' ) }}</small>
                                            </p>
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-lg-4">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="category">
                                                {{ __( 'Категория' ) }}
                                            </label>
                                            {!! html_select('category_id', $model->category_id, ['' => __( 'Выбрать категорию' )] + list_data($categories), ['class' => 'custom-select', 'id' => 'category_id']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end row -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="description">
                                        {{ __( 'Вступительный текст' ) }}
                                    </label>
                                    {!! html_textarea('excerpt', ($model->excerpt) ?? '', ['class' => 'form-control', 'id'=>'excerpt', 'rows' => 6]) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="description">
                                        {{ __( 'Текст' ) }}
                                    </label>
                                    {!! html_textarea('description', ($model->description) ?? '', ['class' => 'form-control custom-editor redactorTinymce', 'id'=>'text']) !!}
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

                                    <a href="{{ route('articles.list.index') }}" type="button" class="btn btn-secondary">
                                        {{ __( 'Отмена' ) }}
                                    </a>

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
                                        @if( $model->slug && !$model->is_banner )
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
                                    {!! html_input('text', 'order', ($model->id) ? $model->order : 0, ['class' => 'form-control', 'id' => 'order']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group mb-5">
                                    <label for="published_at">
                                        {{ __( 'Дата' ) }}
                                    </label>
                                    <div class="input-group date datepicker" id="datePicker">
                                        {!! html_input('text', 'published_at', ($model->id) ? $model->published_at->format('Y-m-d') : Date::now()->format('Y-m-d'), ['class' => 'form-control', 'id' => 'published_at']) !!}
                                        <span class="input-group-addon"><i data-feather="calendar"></i></span>
                                    </div>
                                </div>
                                <!-- end form group -->

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Загрузки' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- Margin -->
                                <div class="mb-5">

                                    <!-- File -->
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
                                            data-default-file="{{ ($model->image) ? url('storage' . '/images/articles/' . $model->image) : '' }}"
                                    />
                                    <!-- End File -->

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
                                        {!! html_hidden('is_banner', 0) !!}
                                        {!! html_checkbox('is_banner', $model->is_banner, ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Баннер' ) }}
                                        <i class="input-frame"></i>
                                    </label>

                                    <!-- description -->
                                    <p class="card-description">
                                        {{ __( 'Отметить если это баннер.' ) }}
                                    </p>
                                    <!-- end description -->

                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-check form-check-flat form-check-primary mb-4">

                                    <label class="form-check-label">
                                        {!! html_hidden('is_sale', 0) !!}
                                        {!! html_checkbox('is_sale', $model->is_sale, ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Акция' ) }}
                                        <i class="input-frame"></i>
                                    </label>

                                    <!-- description -->
                                    <p class="card-description">
                                        {{ __( 'Отметить эту запись как акция.' ) }}
                                    </p>
                                    <!-- end description -->

                                </div>
                                <!-- end form group -->

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
