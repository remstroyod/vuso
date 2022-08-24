@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'reviews' => [
                'title'     => __( 'Отзывы' ),
                'url'       => route('reviews.edit'),
                'active'    => false
            ],
            'reviews-list' => [
                'title'     => __( 'Список' ),
                'url'       => route('reviews.list.index'),
                'active'    => false
            ],
            'reviews-list-form' => [
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

            @includeWhen($model->id, 'pages.reviews.list.tabs', ['reviews' => $model])

            <!-- Form -->
            <form action="{{ route(($model->id ? 'reviews.list.update' : 'reviews.list.store'), $model) }}" method="post" enctype="multipart/form-data">
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
                                            <label for="email">
                                                {{ __( 'E-mail' ) }}
                                            </label>
                                            {!! html_input('text', 'email', $model->email, ['class' => 'form-control', 'id' => 'email']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end row -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="source">
                                        {{ __( 'Источник' ) }}
                                    </label>
                                    {!! html_input('text', 'source', $model->source, ['class' => 'form-control', 'id' => 'source']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="description">
                                        {{ __( 'Текст отзыва' ) }}
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

                                    <a href="{{ route('reviews.list.index') }}" type="button" class="btn btn-secondary">
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
                                <div class="form-group mb-4">
                                    <label for="published_at">
                                        {{ __( 'Дата публикации' ) }}
                                    </label>
                                    <div class="input-group date datepicker" id="datePicker">
                                        {!! html_input('text', 'published_at', ($model->id) ? $model->published_at->format('Y-m-d') : Date::now()->format('Y-m-d'), ['class' => 'form-control', 'id' => 'published_at']) !!}
                                        <span class="input-group-addon"><i data-feather="calendar"></i></span>
                                    </div>
                                </div>
                                <!-- end form group -->

                                <hr>

                                <!-- Title -->
                                <h6 class="card-title pt-3">
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
                                            data-default-file="{{ ($model->image) ? url('storage' . '/images/reviews/' . $model->image) : '' }}"
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
