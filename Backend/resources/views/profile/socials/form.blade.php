@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'profile' => [
                'title'     => __( 'Профиль' ),
                'url'       => route('users.profile.index'),
                'active'    => false
            ],
            'profile-general' => [
                'title'     => __( 'Основное' ),
                'url'       => route('users.profile.edit'),
                'active'    => false
            ],
            'profile-socials' => [
                'title'     => __( 'Соц. сети' ),
                'url'       => route('users.profile.socials.index'),
                'active'    => false,
            ],
            'profile-socials-form' => [
                'title'     => $title,
                'url'       => '',
                'active'    => true,
            ],
        ]
    ])


    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12 grid-margin">

            <!-- Title -->
            <h4 class="card-title">
                {{ $title }}
            </h4>
            <!-- End Title -->

            @include('template-parts.message')

            @include('profile.tabs')

            <!-- Form -->
            <form action="{{ route( ($model->id) ? 'users.profile.socials.update' : 'users.profile.socials.store', ['socials' => $model]) }}" method="post" enctype="multipart/form-data">
            @csrf

                <!-- Row -->
                <div class="row">

                    <!-- Col -->
                    <div class="col-lg-12 grid-margin stretch-card">

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
                                            <label for="image">
                                                {{ __( 'Иконка' ) }}
                                            </label>
                                            {!! html_select('image', $model->image, ['' => __( 'Выбрать иконку' )] + $icons, ['class' => 'custom-select', 'id' => 'image']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                </div>
                                <!-- End Row -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="url">
                                        {{ __( 'Ссылка' ) }}
                                    </label>
                                    {!! html_input('text', 'url', $model->name, ['class' => 'form-control', 'id' => 'url']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- fieldset -->
                                <fieldset>

                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>

                                    <a href="{{ route('users.profile.socials.index') }}" type="button" class="btn btn-secondary">
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
