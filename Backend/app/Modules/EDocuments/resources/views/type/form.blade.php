@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? $model->name : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'modules' => [
                    'title'     => __( 'Модули' ),
                    'url'       => '',
                    'active'    => true,
            ],
            'edocuments' => [
                'title'     => __( 'EDocuments' ),
                'url'       => '',
                'active'    => true,
            ],
            'edocuments-list' => [
                'title'     => __( 'Типы документов' ),
                'url'       => route('edocuments.type.index'),
                'active'    => false
            ],
            'edocuments-list-form' => [
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

            @include('EDocuments::type.tabs', ['model' => $model])

            <!-- Form -->
            <form action="{{ route(($model->id ? 'edocuments.type.update' : 'edocuments.type.store'), $model) }}" method="post" enctype="multipart/form-data">
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

                                <!-- Row -->
                                <div class="row">

                                    <!-- Col -->
                                    <div class="col-lg-7">

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
                                    <!-- End Col -->

                                    <!-- Col -->
                                    <div class="col-lg-5">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="use">
                                                {{ __( 'Назначение' ) }}
                                            </label>
                                            {!! html_select('use', $model->use, $use, ['class' => 'custom-select', 'id' => 'use']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- End Col -->

                                </div>
                                <!-- End Row -->



                                <!-- form group -->
                                <div class="form-group">
                                    <label for="description">
                                        {{ __( 'Описание' ) }}
                                    </label>
                                    {!! html_textarea('description', ($model->description) ?? '', ['class' => 'form-control custom-editor redactorTinymce', 'id'=>'text']) !!}
                                </div>
                                <!-- end form group -->

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

                                    <a href="{{ route('edocuments.type.index') }}" type="button" class="btn btn-secondary">
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
                                <div class="form-group">

                                    <label for="template_id">
                                        {{ __( 'Шаблон' ) }}
                                    </label>

                                    {!! html_select('template_id', $model->template_id, ['' => __( 'Выбрать' )] + list_data($templates), ['class' => 'custom-select', 'id' => 'template_id']) !!}

                                    @error('template_id')
                                    <div class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror

                                <!-- box -->
                                    <div class="pt-1">

                                        <!-- description -->
                                        <p class="card-description">
                                            {{ __( 'Укажите шаблон, который будет использоваться по умолчанию.' ) }}
                                        </p>
                                        <!-- end description -->

                                    </div>
                                    <!-- end box -->

                                </div>
                                <!-- end form group -->

                                <hr>

                                <!-- Title -->
                                <h6 class="card-title">
                                    {{ __( 'API' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="endpoint">
                                        {{ __( 'Endpoint' ) }}
                                    </label>
                                    @php( $readonly = ($model->type === 1) ? ['readonly' => 'readonly'] : ['no' => ''] )
                                    {!! html_input('text', 'endpoint', $model->endpoint, ['class' => 'form-control', 'id' => 'endpoint'] + $readonly) !!}
                                    @error('endpoint')
                                        <div class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror

                                    <div class="pt-1">

                                        <!-- description -->
                                        <p class="card-description">
                                            <small>
                                                {{ __( 'Это дефолтный документ, поэтому endpoint изменить нельзя.' ) }}
                                            </small>
                                        </p>
                                        <!-- end description -->

                                        <!-- description -->
                                        <p class="card-description">
                                            {{ __( 'Endpoint - это идентификатор запроса API. Не изменяйте его, если не уверенны в своих действиях.' ) }}
                                        </p>
                                        <!-- end description -->

                                    </div>


                                </div>
                                <!-- end form group -->

                                <hr>

                                @if( $model->id )
                                    <!-- form group -->
                                    <div class="form-group">
                                        <label for="folder">
                                            {{ __( 'Папка API (GoogleDrive)' ) }}
                                        </label>
                                        <select name="folder" id="folder">
                                            <option value="">{{ __( 'Выбрать' ) }}</option>
                                            @if( $folders )
                                                @foreach( $folders as $folder )
                                                    <option value="{{ $folder['path'] }}" @if( $model->folder == $folder['path'] ) selected @endif>{{ $folder['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>

                                        @error('folder')
                                        <div class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror

                                        <!-- box -->
                                        <div class="pt-1">

                                            <!-- description -->
                                            <p class="card-description">
                                                {{ __( 'Укажите папку, для сохранения файла.' ) }}
                                            </p>
                                            <!-- end description -->

                                        </div>
                                        <!-- end box -->

                                    </div>
                                    <!-- end form group -->
                                @endif

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
