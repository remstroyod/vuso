@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? __( 'Редактирование записи' ) : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'constructor' => [
                'title'     => __( 'Конструктор' ),
                'url'       => route('constructor.index'),
                'active'    => false
            ],
            'constructor-edit' => [
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

            @includeWhen($model->id, 'pages.constructor.tabs')

            <!-- Form -->
            <form action="{{ ($model->id) ? route('constructor.update', $model) : route('constructor.store') }}" method="post" enctype="multipart/form-data">
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
                                        {{ __( 'Данные' ) }}
                                    </h6>
                                    <!-- End Title -->

                                    <!-- row -->
                                    <div class="row">

                                        <!-- Col -->
                                        <div class="col-lg-6">

                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="name">
                                                    {{ __( 'Имя' ) }}
                                                </label>
                                                {!! html_input('text', 'name', $model->name, ['class' => 'form-control', 'id' => 'name']) !!}
                                            </div>
                                            <!-- end form group -->

                                        </div>
                                        <!-- End Col -->

                                        <!-- Col -->
                                        <div class="col-lg-6">

                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="page">
                                                    {{ __( 'Ссылка' ) }}
                                                </label>

                                                {!! html_input('text', 'page', $model->page, ['class' => 'form-control', 'id' => 'page']) !!}

                                                @if( $model->id )
                                                    <div class="pt-1">
                                                        <a
                                                                href="{{ $model->getPreviewUrl() }}"
                                                                target="_blank"
                                                        >
                                                            {{ $model->getPreviewUrl() }}
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                            <!-- end form group -->

                                        </div>
                                        <!-- End Col -->

                                    </div>
                                    <!-- end row -->

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

                                        <a href="{{ route('constructor.index') }}" type="button" class="btn btn-secondary">
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

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
