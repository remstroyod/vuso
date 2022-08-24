@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'sales' => [
                'title'     => __( 'Акции' ),
                'url'       => route('sales.edit'),
                'active'    => false
            ],
            'sales-list' => [
                'title'     => __( 'Список' ),
                'url'       => route('sales.list.index'),
                'active'    => false
            ],
            'sales-list-form' => [
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

            @includeWhen($model->id, 'pages.sales.list.tabs', ['sales' => $model])

            <!-- Form -->
            <form action="{{ route(($model->id ? 'sales.list.update' : 'sales.list.store'), $model) }}" method="post" enctype="multipart/form-data">
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
                                    <div class="col-8">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __( 'Наименование' ) }}
                                            </label>
                                            {!! html_input('text', 'name', $model->name, ['class' => 'form-control', 'id' => 'name']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-4">

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
                                    <label for="date_end">
                                        {{ __( 'Дата окончания акции:' ) }}
                                    </label>

                                    <div class="input-group date datepicker" id="datePickerTime">
                                        {!! html_input('text', 'date_end', $model->date_end, ['class' => 'form-control', 'id' => 'date_end']) !!}
                                        <span class="input-group-addon"><i data-feather="calendar"></i></span>
                                    </div>

                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="excerpt">
                                        {{ __( 'Краткий текст' ) }}
                                    </label>
                                    {!! html_textarea('excerpt', ($model->excerpt) ?? '', ['rows' => 8, 'class' => 'form-control custom-editor', 'id'=>'excerpt']) !!}
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

                                    <a href="{{ route('sales.list.index') }}" type="button" class="btn btn-secondary">
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
                                <div class="form-group mb-5">
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
                                            data-default-file="{{ ($model->image) ? url('storage' . '/images/sales/' . $model->image) : '' }}"
                                    />
                                    <!-- End File -->

                                </div>
                                <!-- End Margin -->

                                <!-- Margin -->
                                <div class="mb-5">

                                    <!-- File -->
                                    <p class="card-description">
                                        {{ __( 'Файл' ) }}
                                    </p>
                                    <input
                                            type="file"
                                            id="fileUpload"
                                            name="input_file"
                                            class="border"
                                            data-max-file-size="10M"
                                            data-allowed-file-extensions="pdf"
                                            data-default-file="{{ ($model->file) ? url('storage' . '/files/sales/' . $model->file) : '' }}"
                                    />
                                    <!-- End File -->

                                </div>
                                <!-- End Margin -->

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
