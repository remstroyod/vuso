@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'roles' => [
                'title'     => __( 'Права и роли' ),
                'url'       => '',
                'active'    => true,
            ],
            'roles-list' => [
                'title'     => __( 'Роли' ),
                'url'       => route('security.roles.index'),
                'active'    => false
            ],
            'roles-list-form' => [
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
            <form action="{{ route(($model->id ? 'security.roles.update' : 'security.roles.store'), $model) }}"
                  method="post" enctype="multipart/form-data">
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
                                <div class="row mb-3">

                                    <!-- col -->
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
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-lg-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="slug">
                                                {{ __( 'Идентификатор' ) }}
                                            </label>
                                            @php( $readonly = ($model->type === 1) ? ['readonly' => 'readonly'] : ['no' => ''] )
                                            {!! html_input('text', 'slug', $model->slug, ['class' => 'form-control', 'id' => 'slug'] + $readonly) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end row -->

                                @unless( $model->slug == 'admin' )
                                    <!-- Title -->
                                    <h6 class="card-title">
                                        {{ __( 'Права' ) }}
                                    </h6>
                                    <!-- End Title -->

                                    <p class="card-description">
                                        {{ __( 'Прикрепите необходимые права к роли.' ) }} {{ __( 'Создать права вы можете здесь' ) }}
                                        : <a href="{{ route('security.permission.index') }}">{{ __( 'Права' ) }}</a>
                                    </p>

                                    <!-- form group -->
                                    <div class="form-group">

                                        {!! html_select('permissions[]', ($model->id) ? $model->permissions->map->id->toArray() : [], list_data($permissions), ['class' => 'js-example-basic-multiple w-100', 'multiple' => 'multiple', 'id' => 'permissions', 'rows' => 5]) !!}

                                    </div>
                                    <!-- end form group -->
                                @endunless

                                <!-- fieldset -->
                                <fieldset>

                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>

                                    <a href="{{ route('security.roles.index') }}" type="button"
                                       class="btn btn-secondary">
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
                                    {{ __( 'Информация' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- Margin -->
                                <div class="mb-5">

                                    <!-- description -->
                                    <p class="card-description">
                                        {{ __( 'Идентификатор роли, можно указывать только при создании записи. Во время редактирования записи, идентификатор нельзя изменять.' ) }}
                                    </p>
                                    <!-- End description -->

                                    <hr>

                                    <!-- description -->
                                    <p class="card-description">
                                        {{ __( 'Если идентификатор не задан, то, он будет создан автоматически из названия роли.' ) }}
                                    </p>
                                    <!-- End description -->

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
