@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'catalog' => [
                'title'     => request()->routeIs('catalog.contragents.*') ? __( 'Каталог' ) : __( 'Каталог B2B' ),
                'url'       => request()->routeIs('catalog.contragents.*') ? route('catalog.edit') : route('b2b.edit'),
                'active'    => false
            ],
            'catalog-contragents' => [
                'title'     => __( 'Контрагенты' ),
                'url'       => request()->routeIs('catalog.contragents.*') ? route('catalog.contragents.index') : route('b2b.contragents.index'),
                'active'    => false
            ],
            'catalog-contragents-form' => [
                'title'     => $title,
                'url'       => '',
                'active'    => true
            ]
        ]
    ])

    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12">

            <!-- Title -->
            <h4 class="card-title">
                {{ $title }}
            </h4>
            <!-- End Title -->

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12 grid-margin ">

            @include('template-parts.message')

            @include('pages.catalog.tabs', ['model' => $page, 'contragents' => $model])

            <!-- Form -->
            <form action="{{ request()->routeIs('catalog.contragents.*') ? route(($model->id ? 'catalog.contragents.update' : 'catalog.contragents.store'), $model) : route(($model->id ? 'b2b.contragents.update' : 'b2b.contragents.store'), $model) }}" method="post" enctype="multipart/form-data">
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

                                <!-- row -->
                                <div class="row">

                                    <!-- col -->
                                    <div class="col-7">

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
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-5">

                                        <!-- form group -->
                                        <div class="form-group">
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

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end row -->

                                <!-- fieldset -->
                                <fieldset>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>
                                    <a href="{{ request()->routeIs('catalog.contragents.*') ? route('catalog.contragents.index') : route('b2b.contragents.index') }}" type="button" class="btn btn-secondary">
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
                                        {!! html_hidden('is_attach', 0) !!}
                                        {!! html_checkbox('is_attach', $model->is_attach, ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Закрепить запись' ) }}
                                        <i class="input-frame"></i>
                                    </label>

                                    <!-- description -->
                                    <p class="card-description pt-2">
                                        {{ __( 'Отметьте если это основная категория' ) }}
                                    </p>
                                    <!-- end description -->

                                </div>
                                <!-- end form group -->

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'Информация' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- form group -->
                                <div class="form-group">
                                    <p class="card-description">
                                        {{ __( 'Контрагенты – это как физические, так и юридические лица, что являются одной из сторон сделки; это все, кто связан договорными отношениями.' ) }}
                                    </p>
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
