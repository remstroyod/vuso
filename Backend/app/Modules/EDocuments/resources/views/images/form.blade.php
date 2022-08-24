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
                'edocuments-docs' => [
                    'title'     => __( 'Документы' ),
                    'url'       => route('edocuments.index'),
                    'active'    => false
                ],
                'edocuments-docs-form' => [
                    'title'     => $document->name,
                    'url'       => route('edocuments.edit', $document),
                    'active'    => false
                ],
                'edocuments-docs-form-images' => [
                    'title'     => __( 'Изображения' ),
                    'url'       => route('edocuments.images.index', $document),
                    'active'    => false
                ],
                'edocuments-docs-form-images-form' => [
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

            @includeWhen($model->id, 'EDocuments::tabs', ['model' => $document])

            <!-- Form -->
            <form
                    action="{{ route(($model->id ? 'edocuments.images.update' : 'edocuments.images.store'), ['document' => $document, 'image' => $model]) }}"
                    method="post"
                    enctype="multipart/form-data"
            >
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

                                <!-- Row -->
                                <div class="row">

                                    <!-- Col -->
                                    <div class="col-lg-12">

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

                                </div>
                                <!-- End Row -->

                                <!-- fieldset -->
                                <fieldset>

                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>

                                    <a href="{{ route('edocuments.images.index', $document) }}" type="button" class="btn btn-secondary">
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
                                            data-default-file="{{ ($model->image) ? url('storage' . '/images/modules/edocuments/images/' . $model->image) : '' }}"
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
