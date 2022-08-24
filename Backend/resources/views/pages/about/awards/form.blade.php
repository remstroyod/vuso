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
                'awards' => [
                    'title'     => __( 'Награды компании' ),
                    'url'       => route('about.awards.index', $model),
                    'active'    => false,
                ],
                'awards-form' => [
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
            <form action="{{ route(((isset($item)) ? 'about.awards.update' : 'about.awards.store'), (isset($item)) ? $item : $model) }}" method="post" enctype="multipart/form-data">
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

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="name">
                                        {{ __( 'Наименование' ) }}
                                    </label>
                                    {!! html_input('text', 'name', (isset($item)) ? $item->name : '', ['class' => 'form-control', 'id' => 'name']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="nomination">
                                        {{ __( 'Номинация' ) }}
                                    </label>
                                    {!! html_input('text', 'nomination', (isset($item)) ? $item->nomination : '', ['class' => 'form-control', 'id' => 'nomination']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="from">
                                        {{ __( 'От' ) }}
                                    </label>
                                    {!! html_input('text', 'from', (isset($item)) ? $item->from : '', ['class' => 'form-control', 'id' => 'from']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="date">
                                        {{ __( 'Год' ) }}
                                    </label>

                                    <div class="input-group date">
                                        {!! html_input('text', 'date', (isset($item) && !empty($item->date)) ? $item->date->format('Y') : '', ['class' => 'form-control']) !!}
                                    </div>

                                </div>
                                <!-- end form group -->

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

                                    <a href="{{ route('about.awards.index') }}" type="button" class="btn btn-secondary">
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
                                        {{ __( 'Файл' ) }}
                                    </p>
                                    <input
                                            type="file"
                                            id="fileUpload"
                                            name="input_file"
                                            class="border"
                                            data-max-file-size="10M"
                                            data-allowed-file-extensions="pdf"
                                            @isset( $item )
                                            data-default-file="{{ ($item->file) ? url('storage' . '/files/about/awards/' . $item->file) : '' }}"
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
