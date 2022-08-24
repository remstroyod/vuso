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
            'partners-categories' => [
                'title'     => __( 'Категории' ),
                'url'       => route('partners.categories.index'),
                'active'    => false
            ],
            'partners-categories-form' => [
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

            @includeWhen($model->id, 'pages.partners.categories.tabs', ['categories' => $model])

            <!-- stretch -->
            <div class="stretch-card">

                <!-- card -->
                <div class="card">

                    <!-- card-body -->
                    <div class="card-body">

                        <!-- Form -->
                        <form action="{{ route(($model->id ? 'partners.categories.update' : 'partners.categories.store'), $model) }}" method="post" enctype="multipart/form-data">
                        @csrf

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
                                        <label for="parent_id">
                                            {{ __( 'Категория' ) }}
                                        </label>
                                        {!! html_select('parent_id', $model->parent_id, ['' => __( 'Выбрать категорию' )] + list_data($categories), ['class' => 'custom-select', 'id' => 'parent_id']) !!}
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
                            </fieldset>
                            <!-- end fieldset -->

                        </form>
                        <!-- End Form -->

                    </div>
                    <!-- end card-body -->

                </div>
                <!-- end card -->

            </div>
            <!-- end stretch -->

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
