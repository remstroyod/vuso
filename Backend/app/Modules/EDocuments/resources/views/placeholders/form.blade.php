@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'modules' => [
                    'title'     => __( 'Модули' ),
                    'url'       => '',
                    'active'    => true,
            ],
            'edocuments' => [
                'title'     => __( 'EDocuments' ),
                'url'       => '',
                'active'    => true,
            ],
            'edocuments-list' => [
                'title'     => __( 'Плейсхолдеры' ),
                'url'       => route('edocuments.placeholders.index'),
                'active'    => false
            ],
            'edocuments-list-form' => [
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

            @include('EDocuments::placeholders.tabs', ['model' => $model])

            <!-- Form -->
            <form action="{{ route(($model->id ? 'edocuments.placeholders.update' : 'edocuments.placeholders.store'), $model) }}" method="post" enctype="multipart/form-data">
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

                                    <!-- Col -->
                                    <div class="col-lg-4">

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
                                            <label for="slug">
                                                {{ __( 'Идентификатор' ) }}
                                            </label>
                                            {!! html_input('text', 'slug', $model->slug, ['class' => 'form-control', 'id' => 'slug']) !!}
                                            @error('slug')
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
                                            <label for="render">
                                                {{ __( 'Тестовое значение' ) }}
                                            </label>
                                            {!! html_input('text', 'render', $model->render, ['class' => 'form-control', 'id' => 'render']) !!}
                                            @error('render')
                                            <div class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                            @enderror
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                </div>
                                <!-- end row -->

                                <!-- fieldset -->
                                <fieldset>

                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>

                                    <a href="{{ route('edocuments.placeholders.index') }}" type="button" class="btn btn-secondary">
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
                                    {{ __( 'Информация' ) }}
                                </h6>
                                <!-- End Title -->

                                <hr>

                                <!-- description -->
                                <p class="card-description">
                                    {{ __( 'Идентификатор - это уникальное значение, например First Name, которое должно указываться латинскими символами, без пробелов, и прочих символов, например: first_name' ) }}
                                </p>
                                <!-- end description -->

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

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
