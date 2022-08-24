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
                'history' => [
                    'title'     => __( 'История компании' ),
                    'url'       => route('about.history.index', $model),
                    'active'    => false,
                ],
                'history-form' => [
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
            <form action="{{ route(((isset($item)) ? 'about.history.update' : 'about.history.store'), (isset($item)) ? $item : $model) }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Row -->
                <div class="row">

                    <!-- Col -->
                    <div class="col-lg-8 grid-margin stretch-card">

                        <!-- card -->
                        <div class="card">

                            <!-- card-body -->
                            <div class="card-body">

                                <!-- row -->
                                <div class="row">

                                    <!-- Col -->
                                    <div class="col-md-12">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __( 'Наименование' ) }}
                                            </label>
                                            {!! html_textarea('name', (isset($item)) ? $item->name : '', ['class' => 'form-control', 'id'=>'name', 'rows' => 3]) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-md-4">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="year">
                                                {{ __( 'Год' ) }}
                                            </label>
                                            {!! html_input('text', 'year', (isset($item)) ? $item->year : '', ['class' => 'form-control', 'id' => 'year']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-md-8">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="select">
                                                {{ __( 'Тип' ) }}
                                            </label>
                                            {!! html_select('select', (isset($item)) ? $item->select : '', ['green' => 'green', 'purple' => 'purple'], ['class' => 'custom-select', 'id' => 'select']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-md-12">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="hint">
                                                {{ __( 'Подсказка' ) }}
                                            </label>
                                            {!! html_textarea('hint', (isset($item)) ? $item->hint : '', ['class' => 'form-control', 'id'=>'hint', 'rows' => 6]) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                </div>
                                <!-- end row -->

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
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        {!! html_hidden('is_active', 0) !!}
                                        {!! html_checkbox('is_active', (isset($item->is_active)) ? $item->is_active : 1, ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Активный' ) }}
                                        <i class="input-frame"></i> </label>
                                </div>
                                <!-- end form group -->

                                <button type="submit" class="btn btn-primary">
                                    {{ __( 'Сохранить' ) }}
                                </button>

                                <a href="{{ route('about.history.index') }}" type="button" class="btn btn-secondary">
                                    {{ __( 'Отмена' ) }}
                                </a>

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
