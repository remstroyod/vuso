@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'partners' => [
                'title'     => __( 'Партнеры' ),
                'url'       => route('partners.edit'),
                'active'    => false
            ],
            'partners-list' => [
                'title'     => __( 'Список' ),
                'url'       => route('partners.list.index'),
                'active'    => false
            ],
            'partners-list-form' => [
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

            @includeWhen($model->id, 'pages.partners.list.tabs', ['partners' => $model])

            <!-- Form -->
            <form action="{{ route(($model->id ? 'partners.list.update' : 'partners.list.store'), $model) }}" method="post" enctype="multipart/form-data">
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
                                            {!! html_select('category_id', $model->category_id, list_data($categories), ['class' => 'custom-select', 'id' => 'category_id']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end row -->

                                <hr>

                                <!-- form group -->
                                <div class="form-group">

                                    <label for="tag">
                                        {{ __( 'Тэги' ) }}
                                    </label>

                                    {!! html_select('tag[]', $model->tags->map->id->toArray(), list_data($tags), ['class' => 'js-example-basic-multiple-tags w-100', 'multiple' => 'multiple', 'id' => 'tag', 'rows' => 6]) !!}

                                    <p class="card-description pt-3 mb-0">
                                        {{ __( 'Что бы создать новый тэг, введите его и нажмите Enter.' ) }}
                                    </p>
                                    <p class="card-description pt-0">
                                        {{ __( 'Перевод и удаление тегов доступны в следующем разделе' ) }}: <a href="{{ route('tag.index') }}">{{ __( 'Тэги' ) }}</a>
                                    </p>

                                    <hr>

                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="excerpt">
                                        {{ __( 'Отрывок' ) }}
                                    </label>
                                    {!! html_textarea('excerpt', ($model->excerpt) ?? '', ['class' => 'form-control custom-editor redactorTinymce', 'id'=>'excerpt']) !!}
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

                                    <a href="{{ route('partners.list.index') }}" type="button" class="btn btn-secondary">
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
                                    <label for="order">
                                        {{ __( 'Позиция' ) }}
                                    </label>
                                    {!! html_input('text', 'order', (isset($model->order)) ? $model->order : '', ['class' => 'form-control', 'id' => 'order']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Загрузки' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- Margin -->
                                <div class="mb-3">

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
                                            data-default-file="{{ ($model->image) ? url('storage' . '/images/partners/' . $model->image) : '' }}"
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
