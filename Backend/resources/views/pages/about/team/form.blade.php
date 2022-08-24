@extends('layouts.app')

@section('content')

    @php( $title = (isset($item)) ? __( 'Редактирование записи' ) : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
            'breadcrumbsList' => [
                'about' => [
                    'title'     => __( 'О компании' ),
                    'url'       => route('about.edit', $model),
                    'active'    => false,
                ],
                'team' => [
                    'title'     => __( 'Команда' ),
                    'url'       => route('about.team.index', $model),
                    'active'    => false,
                ],
                'team-form' => [
                    'title'     => $title,
                    'url'       => '',
                    'active'    => true,
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

            @includeWhen($model, 'pages.about.tabs', ['pages' => $model])

            <!-- Form -->
            <form action="{{ route(((isset($item)) ? 'about.team.update' : 'about.team.store'), (isset($item)) ? $item : $model) }}" method="post" enctype="multipart/form-data">
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
                                    <div class="col-lg-5">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __( 'Наименование' ) }}
                                            </label>
                                            {!! html_input('text', 'name', (isset($item)) ? $item->name : '', ['class' => 'form-control', 'id' => 'name']) !!}
                                            @error('name')
                                            <label id="name-error" class="error mt-2 text-danger" for="name">
                                                {{ __( 'Обязательное поле' ) }}
                                            </label>
                                            @enderror
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-lg-7">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="position">
                                                {{ __( 'Должность' ) }}
                                            </label>
                                            {!! html_input('text', 'position', (isset($item)) ? $item->position : '', ['class' => 'form-control', 'id' => 'position']) !!}
                                            @error('position')
                                            <label id="position-error" class="error mt-2 text-danger" for="position">
                                                {{ __( 'Обязательное поле' ) }}
                                            </label>
                                            @enderror
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end row -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="description">
                                        {{ __( 'Текст' ) }}
                                    </label>
                                    {!! html_textarea('description', (isset($item)) ? $item->description : '', ['class' => 'form-control', 'id'=>'description', 'rows' => 7]) !!}
                                </div>
                                <!-- end form group -->

                                <!-- row -->
                                <div class="row">

                                    <!-- col -->
                                    <div class="col-lg-5">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="email">
                                                {{ __( 'E-mail' ) }}
                                            </label>
                                            {!! html_input('text', 'email', (isset($item)) ? $item->email : '', ['class' => 'form-control', 'id' => 'email']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-lg-7">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="position">
                                                {{ __( 'Ссылка на LinkedIn' ) }}
                                            </label>
                                            {!! html_input('text', 'linkedin', (isset($item)) ? $item->linkedin : '', ['class' => 'form-control', 'id' => 'linkedin']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end row -->

                                <!-- form group -->
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        {!! html_hidden('is_active', 0) !!}
                                        {!! html_checkbox('is_active', (isset($item)) ? $item->is_active : '', ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Активный' ) }}
                                        <i class="input-frame"></i> </label>
                                </div>
                                <!-- end form group -->

                                <!-- fieldset -->
                                <fieldset>

                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>

                                    <a href="{{ route('about.team.index') }}" type="button" class="btn btn-secondary">
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
                                    {!! html_input('text', 'order', (isset($item->order)) ? $item->order : '', ['class' => 'form-control', 'id' => 'order']) !!}
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
                                            @isset( $item )
                                            data-default-file="{{ ($item->image) ? url('storage' . '/images/about/team/' . $item->image) : '' }}"
                                            @endisset
                                    />
                                    <!-- End File -->

                                </div>
                                <!-- End Margin -->

                                <!-- Margin -->
                                <div class="mb-5">

                                    <!-- File -->
                                    <p class="card-description">
                                        {{ __( 'Изображение обратной стороны' ) }}
                                    </p>
                                    <input
                                            type="file"
                                            id="avatarUpload"
                                            name="image_revert"
                                            class="border"
                                            data-max-file-size="3M"
                                            data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                                            @isset( $item )
                                            data-default-file="{{ ($item->image_revert) ? url('storage' . '/images/about/team/' . $item->image_revert) : '' }}"
                                            @endisset
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
