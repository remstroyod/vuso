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
                'countries' => [
                    'title'     => __( 'Города' ),
                    'url'       => route('contacts.countries.index', $model),
                    'active'    => false,
                ],
                'countries-form' => [
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

            <!-- stretch -->
            <div class="stretch-card">

                <!-- card -->
                <div class="card">

                    <!-- card-body -->
                    <div class="card-body">

                        <!-- Form -->
                        <form action="{{ route(((isset($item)) ? 'contacts.countries.update' : 'contacts.countries.store'), (isset($item)) ? $item : $model) }}" method="post" enctype="multipart/form-data">
                        @csrf

                            <!-- row -->
                            <div class="row">

                                <!-- Col -->
                                <div class="col-md-8">

                                    <!-- form group -->
                                    <div class="form-group">
                                        <label for="name">
                                            {{ __( 'Наименование' ) }}
                                        </label>
                                        {!! html_input('text', 'name', (isset($item)) ? $item->name : '', ['class' => 'form-control', 'id' => 'name']) !!}
                                    </div>
                                    <!-- end form group -->

                                </div>
                                <!-- End Col -->

                                <!-- Col -->
                                <div class="col-md-4">

                                    <!-- form group -->
                                    <div class="form-group">
                                        <label for="slug">
                                            {{ __( 'URL (формируется автоматически)' ) }}
                                        </label>
                                        {!! html_input('text', 'slug', (isset($item)) ? $item->slug : '', ['class' => 'form-control', 'id' => 'slug']) !!}
                                    </div>
                                    <!-- end form group -->

                                </div>
                                <!-- End Col -->

                            </div>
                            <!-- end row -->

                            <!-- fieldset -->
                            <fieldset>



                                <!-- form group -->
                                <div class="form-check form-check-flat form-check-primary">
                                    <label class="form-check-label">
                                        {!! html_hidden('is_active', 0) !!}
                                        {!! html_checkbox('is_active', (isset($item)) ? $item->is_active : '', ['class' => 'form-check-input', 'value' => 1]) !!}
                                        {{ __( 'Активный' ) }}
                                        <i class="input-frame"></i> </label>
                                </div>
                                <!-- end form group -->

                                <button type="submit" class="btn btn-primary">
                                    {{ __( 'Сохранить' ) }}
                                </button>

                                <a href="{{ route('contacts.countries.index') }}" type="button" class="btn btn-secondary">
                                    {{ __( 'Отмена' ) }}
                                </a>

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
