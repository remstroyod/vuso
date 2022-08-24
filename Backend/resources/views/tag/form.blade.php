@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'tag' => [
                'title'     => __( 'Тэги' ),
                'url'       => route('tag.index'),
                'active'    => false
            ],
            'tag-form' => [
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

            <!-- Form -->
            <form action="{{ route(($model->id ? 'tag.update' : 'tag.store'), $model) }}" method="post" enctype="multipart/form-data">
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
                                    {!! html_input('text', 'name', $model->name, ['class' => 'form-control', 'id' => 'name']) !!}
                                </div>
                                <!-- end form group -->

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

                                <button type="submit" class="btn btn-primary">
                                    {{ __( 'Сохранить' ) }}
                                </button>

                                <a href="{{ route('tag.index') }}" type="button" class="btn btn-secondary">
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
