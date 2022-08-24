@extends('layouts.app')

@section('content')

    @php( $title = __( 'Настройки сайта' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'settings' => [
                'title'     => __( 'Настройки' ),
                'url'       => route('settings.edit'),
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

            @include('settings.tabs')

            <!-- Form -->
            <form action="{{ route('settings.update') }}" method="post" enctype="multipart/form-data">
            @csrf

                <!-- tab content -->
                <div class="tab-content grid-margin" id="settingsTabContent">

                    <!-- tab general -->
                    <div
                            class="tab-pane fade show active"
                            id="settings-tab-general"
                            role="tabpanel"
                            aria-labelledby="settings-tab-general-tab"
                    >

                        <!-- Row -->
                        <div class="row">

                            <!-- Col -->
                            <div class="col-lg-8 stretch-card">

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
                                            <label for="site_name">
                                                {{ __( 'Название сайта' ) }}
                                            </label>
                                            {!! html_input('text', 'settings[site_name]', $model->site_name, ['class' => 'form-control', 'id' => 'site_name']) !!}
                                        </div>
                                        <!-- end form group -->

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="site_description">
                                                {{ __( 'Описание сайта' ) }}
                                            </label>
                                            {!! html_input('text', 'settings[site_description]', $model->site_description, ['class' => 'form-control', 'id' => 'site_description']) !!}
                                        </div>
                                        <!-- end form group -->

                                        <!-- form group -->
                                        <div class="form-group">
                                            <label for="site_email">
                                                {{ __( 'E-mail' ) }}
                                            </label>
                                            <p class="card-description">
                                                {{ __( 'Этот E-mail будет использоваться если не будет указан иной адрес для форм' ) }}
                                            </p>
                                            {!! html_input('text', 'settings[site_email]', $model->site_email, ['class' => 'form-control', 'id' => 'site_email']) !!}
                                        </div>
                                        <!-- end form group -->

                                        <!-- row -->
                                        <div class="row">

                                            <!-- Col -->
                                            <div class="col-lg-6">

                                                <!-- form group -->
                                                <div class="form-group">
                                                    <label for="site_url">
                                                        {{ __( 'URL сайта: Frontend' ) }}
                                                    </label>
                                                    {!! html_input('text', 'settings[site_url]', $model->site_url, ['class' => 'form-control', 'id' => 'site_url']) !!}
                                                </div>
                                                <!-- end form group -->

                                            </div>
                                            <!-- End Col -->

                                            <!-- Col -->
                                            <div class="col-lg-6">

                                                <!-- form group -->
                                                <div class="form-group">
                                                    <label for="site_url">
                                                        {{ __( 'URL сайта: Admin' ) }}
                                                    </label>
                                                    {!! html_input('text', 'settings[site_url_admin]', $model->site_url_admin, ['class' => 'form-control', 'id' => 'site_url_admin']) !!}
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

                                        <!-- Margin -->
                                        <div class="mb-5">

                                            <!-- Image -->
                                            <p class="card-description">
                                                {{ __( 'Логотип' ) }}
                                            </p>
                                            <input
                                                    type="file"
                                                    id="imageUpload"
                                                    name="site_logo"
                                                    class="border"
                                                    data-max-file-size="3M"
                                                    data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                                                    @if( $model->site_logo )
                                                    data-default-file="{{ url('storage' . '/images/settings/' . $model->site_logo )}}"
                                                    @endif
                                            />
                                            <!-- End Image -->

                                        </div>
                                        <!-- End Margin -->

                                        <!-- Margin -->
                                        <div class="mb-5">

                                            <!-- Image -->
                                            <p class="card-description">
                                                {{ __( 'Логотип мобильная версия' ) }}
                                            </p>
                                            <input
                                                    type="file"
                                                    id="imageLogoMobileUpload"
                                                    name="site_logo_mobile"
                                                    class="border"
                                                    data-max-file-size="3M"
                                                    data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                                                    @if( $model->site_logo_mobile )
                                                    data-default-file="{{ url('storage' . '/images/settings/' . $model->site_logo_mobile )}}"
                                                    @endif
                                            />
                                            <!-- End Image -->

                                        </div>
                                        <!-- End Margin -->

                                        <!-- Margin -->
                                        <div class="mb-5">

                                            <!-- Image -->
                                            <p class="card-description">
                                                {{ __( 'Favicon' ) }}
                                            </p>
                                            <input
                                                    type="file"
                                                    id="faviconUpload"
                                                    name="site_favicon"
                                                    class="border"
                                                    data-max-file-size="3M"
                                                    data-allowed-file-extensions="png jpg jpeg svg gif bmp"
                                                    @if( $model->site_favicon )
                                                    data-default-file="{{ url('storage' . '/images/settings/' . $model->site_favicon )}}"
                                                    @endif
                                            />
                                            <!-- End Image -->

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


                    </div>
                    <!-- end tab general -->

                    <!-- tab forms -->
                    <div
                            class="tab-pane fade"
                            id="settings-tab-forms"
                            role="tabpanel"
                            aria-labelledby="settings-tab-forms-tab"
                    >

                        <!-- stretch card -->
                        <div class="stretch-card">

                            <!-- card -->
                            <div class="card">

                                <!-- card-body -->
                                <div class="card-body">

                                    <!-- Title -->
                                    <h6 class="card-title">
                                        {{ __( 'Настройка' ) }} форм
                                    </h6>
                                    <!-- End Title -->

                                </div>
                                <!-- end card-body -->

                            </div>
                            <!-- end card -->

                        </div>
                        <!-- end stretch card -->

                    </div>
                    <!-- end tab forms -->

                    <!-- tab 1c -->
                    <div
                            class="tab-pane fade"
                            id="settings-tab-1c"
                            role="tabpanel"
                            aria-labelledby="settings-tab-1c-tab"
                    >

                        <!-- stretch card -->
                        <div class="stretch-card">

                            <!-- card -->
                            <div class="card">

                                <!-- card-body -->
                                <div class="card-body">

                                    <!-- Title -->
                                    <h6 class="card-title">
                                        {{ __( 'Настройка' ) }} 1C
                                    </h6>
                                    <!-- End Title -->


                                </div>
                                <!-- end card-body -->

                            </div>
                            <!-- end card -->

                        </div>
                        <!-- end stretch card -->

                    </div>
                    <!-- end tab 1c -->

                    <!-- tab bitrix -->
                    <div
                            class="tab-pane fade"
                            id="settings-tab-bitrix"
                            role="tabpanel"
                            aria-labelledby="settings-tab-bitrix-tab"
                    >

                        <!-- stretch card -->
                        <div class="stretch-card">

                            <!-- card -->
                            <div class="card">

                                <!-- card-body -->
                                <div class="card-body">

                                    <!-- Title -->
                                    <h6 class="card-title">
                                        {{ __( 'Настройка' ) }} Bitrix
                                    </h6>
                                    <!-- End Title -->


                                </div>
                                <!-- end card-body -->

                            </div>
                            <!-- end card -->

                        </div>
                        <!-- end stretch card -->

                    </div>
                    <!-- end tab bitrix -->

                    <!-- tab api -->
                    <div
                            class="tab-pane fade"
                            id="settings-tab-api"
                            role="tabpanel"
                            aria-labelledby="settings-tab-api-tab"
                    >

                        <!-- stretch card -->
                        <div class="stretch-card">

                            <!-- card -->
                            <div class="card">

                                <!-- card-body -->
                                <div class="card-body">

                                    <!-- Title -->
                                    <h6 class="card-title">
                                        {{ __( 'Настройка' ) }} API
                                    </h6>
                                    <!-- End Title -->

                                    <!-- row -->
                                    <div class="row">

                                        <!-- col -->
                                        <div class="col-lg-6">

                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="url_app_api_backend">
                                                    {{ __( 'URL API сайта (Backend)' ) }}
                                                </label>
                                                {!! html_input('text', 'settings[url_app_api_backend]', isset($model->url_app_api_backend) ? $model->url_app_api_backend : '', ['class' => 'form-control', 'id' => 'url_app_api']) !!}
                                            </div>
                                            <!-- end form group -->

                                        </div>
                                        <!-- end col -->

                                        <!-- col -->
                                        <div class="col-lg-6">

                                            <!-- form group -->
                                            <div class="form-group">
                                                <label for="url_app_api_frontend">
                                                    {{ __( 'URL API сайта (Frontend)' ) }}
                                                </label>
                                                {!! html_input('text', 'settings[url_app_api_frontend]', isset($model->url_app_api_frontend) ? $model->url_app_api_frontend : '', ['class' => 'form-control', 'id' => 'url_app_api_frontend']) !!}
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
                        <!-- end stretch card -->

                    </div>
                    <!-- end tab api -->

                </div>
                <!-- end tab content -->

                <!-- fieldset -->
                <fieldset>
                    <button type="submit" class="btn btn-primary">
                        {{ __( 'Сохранить' ) }}
                    </button>
                </fieldset>
                <!-- end fieldset -->

            </form>
            <!-- End Form -->

            @include( 'template-parts.editor' )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
