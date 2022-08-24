@extends('layouts.app')

@section('content')

    @php( $title = (isset($item)) ? __( 'Редактирование записи' ) : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
            'breadcrumbsList' => [
                'contacts' => [
                    'title'     => __( 'Контакты' ),
                    'url'       => route('contacts.edit', $model),
                    'active'    => false,
                ],
                'offices' => [
                    'title'     => __( 'Адреса представительств' ),
                    'url'       => route('contacts.offices.index', $model),
                    'active'    => false,
                ],
                'offices-form' => [
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

            @includeWhen($model, 'pages.contacts.tabs', ['pages' => $model])

            <!-- Form -->
            <form action="{{ route(((isset($item)) ? 'contacts.offices.update' : 'contacts.offices.store'), (isset($item)) ? $item : $model) }}" method="post" enctype="multipart/form-data">
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
                                    <div class="col-sm-8">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="name">
                                                {{ __( 'Наименование' ) }}
                                            </label>
                                            {!! html_input('text', 'name', (isset($item)) ? $item->name : '', ['class' => 'form-control', 'id' => 'name']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-sm-4">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="category">
                                                {{ __( 'Город' ) }}
                                            </label>
                                            {!! html_select('country_id', (isset($item)) ? $item->country_id : 0, ['' => __( 'Выбрать город' )] + list_data($countries), ['class' => 'custom-select', 'id' => 'country_id']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                </div>
                                <!-- end row -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="address">
                                        {{ __( 'Адрес' ) }}
                                    </label>
                                    {!! html_input('text', 'address', (isset($item)) ? $item->address : '', ['class' => 'form-control', 'id' => 'address']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="time">
                                        {{ __( 'Время работы' ) }}
                                    </label>
                                    {!! html_input('text', 'time', (isset($item)) ? $item->time : '', ['class' => 'form-control', 'id' => 'time']) !!}
                                </div>
                                <!-- end form group -->

                                <!-- row -->
                                <div class="row">

                                    <!-- col -->
                                    <div class="col-sm-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="email">
                                                {{ __( 'E-mail' ) }}
                                            </label>
                                            {!! html_input('text', 'email', (isset($item)) ? $item->email : '', ['class' => 'form-control', 'id' => 'email']) !!}
                                        </div>
                                        <!-- end form group -->

                                    </div>
                                    <!-- end col -->

                                    <!-- col -->
                                    <div class="col-sm-6">

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="phone">
                                                {{ __( 'Телефон' ) }}
                                            </label>
                                            {!! html_input('text', 'phone', (isset($item)) ? $item->phone : '', ['class' => 'form-control', 'id' => 'phone']) !!}
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
                                        {!! html_checkbox('is_active', (isset($item)) ? $item->is_active : '', ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Активный' ) }}
                                        <i class="input-frame"></i> </label>
                                </div>
                                <!-- end form group -->

                                <!-- fieldset -->
                                <fieldset>

                                    <button type="submit" class="btn btn-primary">
                                        {{ __( 'Сохранить' ) }}
                                    </button>

                                    <a href="{{ route('contacts.offices.index') }}" type="button" class="btn btn-secondary">
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
                                    {{ __( 'На карте' ) }}
                                </h6>
                                <!-- End Title -->

                                <!-- Margin -->
                                <div class="mb-5">

                                    <!-- form group -->
                                    <div class="form-group">

                                        <label for="coords">
                                            {{ __( 'Координаты' ) }}
                                        </label>

                                        <!-- row -->
                                        <div class="row">

                                            <!-- col -->
                                            <div class="col-sm-6">

                                                {!! html_input('text', 'lat', (isset($item)) ? $item->lat : '', ['placeholder' => 'Lat', 'class' => 'form-control', 'id' => 'lat']) !!}

                                            </div>
                                            <!-- end col -->

                                            <!-- col -->
                                            <div class="col-sm-6">

                                                {!! html_input('text', 'lng', (isset($item)) ? $item->lng : '', ['placeholder' => 'Lng', 'class' => 'form-control', 'id' => 'lng']) !!}

                                            </div>
                                            <!-- end col -->

                                        </div>
                                        <!-- end row -->

                                    </div>
                                    <!-- end form group -->

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

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
