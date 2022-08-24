@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? __( 'Редактирование записи' ) : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
            'breadcrumbsList' => [
                'menu' => [
                    'title'     => __( 'Меню сайта' ),
                    'url'       => route('menu.index'),
                    'active'    => false,
                ],
                'menu-form' => [
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

            @includeWhen($model->id, 'menu.tabs', ['menu' => $model])

            <!-- Form -->
            <form
                    action="{{ ($model->id) ? route('menu.update', $model) : route('menu.store') }}"
                    method="post"
                    enctype="multipart/form-data"
                    class="blocksForm"
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

                                <!-- title -->
                                <h6 class="card-title">
                                    {{ __( 'Основное' ) }}
                                </h6>
                                <!-- end title -->

                                <!-- row -->
                                <div class="row">

                                    <!-- Col -->
                                    <div class="col-lg-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __( 'Наименование' ) }}
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
                                            <label for="title">
                                                {{ __( 'Заголовок' ) }}
                                            </label>
                                            {!! html_input('text', 'title', $model->title, ['class' => 'form-control', 'id' => 'title']) !!}
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
                                        {!! html_checkbox('is_active', $model->is_active, ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Активный' ) }}
                                        <i class="input-frame"></i> </label>
                                </div>
                                <!-- end form group -->

                                <!-- fieldset -->
                                <fieldset>

                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>

                                    <a href="{{ route('menu.index') }}" type="button" class="btn btn-secondary">
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

                                <!-- title -->
                                <h6 class="card-title">
                                    {{ __( 'Прочее' ) }}
                                </h6>
                                <!-- end title -->

                                <!-- form group -->
                                <div class="form-group mb-5">
                                    <label for="order">
                                        {{ __( 'Позиция' ) }}
                                    </label>
                                    {!! html_input('text', 'order', ($model->id) ? $model->order : 0, ['class' => 'form-control', 'id' => 'order']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- title -->
                                <h6 class="card-title">
                                    {{ __( 'Настройки' ) }}
                                </h6>
                                <!-- end title -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="wrapper">
                                        {{ __( 'Обертка' ) }}
                                    </label>
                                    {!! html_select('wrapper', $model->wrapper, $wrapper, ['class' => 'custom-select', 'id' => 'wrapper']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="attrclass">
                                        {{ __( 'CSS: Class' ) }}
                                    </label>
                                    {!! html_input('text', 'attrclass', $model->attrclass, ['class' => 'form-control', 'id' => 'attrclass']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="attrid">
                                        {{ __( 'CSS: ID' ) }}
                                    </label>
                                    {!! html_input('text', 'attrid', $model->attrid, ['class' => 'form-control', 'id' => 'attrid']) !!}
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
