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
            'payhub' => [
                    'title'     => __( 'Модуль: PayHub' ),
                    'url'       => route('payhub.index'),
                    'active'    => false,
            ],
            'payhub-systems' => [
                    'title'     => __( 'Системы оплат' ),
                    'url'       => route('payhub.systems.index'),
                    'active'    => false,
            ],
            'payhub-systems-detail' => [
                    'title'     => $title,
                    'url'       => '',
                    'active'    => true,
            ],
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
            <form action="{{ route(($model->id ? 'payhub.systems.update' : 'payhub.systems.store'), $model) }}" method="post" enctype="multipart/form-data">
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
                                <div class="row">

                                    <!-- col -->
                                    <div class="col-lg-8">

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
                                    <div class="col-lg-4">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="key">
                                                {{ __( 'Идентификатор' ) }}
                                            </label>
                                            @if( request()->routeIs('payhub.systems.create') )
                                                {!! html_input('text', 'key', $model->key, ['class' => 'form-control', 'id' => 'key']) !!}
                                            @else
                                                {!! html_input('text', 'key', $model->key, ['class' => 'form-control', 'id' => 'key', 'readonly' => 'readonly']) !!}
                                            @endif
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-lg-12">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="urlApi">
                                                {{ __( 'API (URL)' ) }}
                                            </label>
                                            {!! html_input('text', 'urlApi', $model->urlApi, ['class' => 'form-control', 'id' => 'urlApi']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-lg-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="partnerKey">
                                                <strong>PartnerKey</strong> - {{ __( 'Уникальный идентификатор партнера (торговца) в системе' ) }}
                                            </label>
                                            {!! html_input('text', 'partnerKey', $model->partnerKey, ['class' => 'form-control', 'id' => 'partnerKey']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-lg-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="seviceKey">
                                                <strong>SeviceKey</strong> - {{ __( 'Идентификатор сервиса (магазина или услуги) торговца в системе' ) }}
                                            </label>
                                            {!! html_input('text', 'seviceKey', $model->seviceKey, ['class' => 'form-control', 'id' => 'seviceKey']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-lg-12">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="secretKey">
                                                <strong>SecretKey</strong> - {{ __( 'Секретный ключ для формирования подписи' ) }}
                                            </label>
                                            {!! html_textarea('secretKey', $model->secretKey, ['class' => 'form-control', 'id'=>'secretKey', 'rows' => 5]) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

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
                                <div class="form-group">
                                    <label for="urlSuccess">
                                        {{ __( 'URL успешной оплаты' ) }}
                                    </label>
                                    {!! html_input('text', 'urlSuccess', $model->urlSuccess, ['class' => 'form-control', 'id' => 'urlSuccess']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group mb-4">
                                    <label for="urlFailed">
                                        {{ __( 'URL ошибки оплаты' ) }}
                                    </label>
                                    {!! html_input('text', 'urlFailed', $model->urlFailed, ['class' => 'form-control', 'id' => 'urlFailed']) !!}
                                </div>
                                <!-- end form group -->

                                <hr>

                                <!-- Title -->
                                <h6 class="card-title pt-3">
                                    {{ __( 'Событие' ) }}
                                </h6>
                                <!-- End Title -->

                                <button type="submit" class="btn btn-primary">
                                    {{ __( 'Сохранить' ) }}
                                </button>

                                <a href="{{ route('payhub.systems.index') }}" type="button" class="btn btn-secondary">
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
