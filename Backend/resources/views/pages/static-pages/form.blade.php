@extends('layouts.app')

@section('content')

    @php( $title = ($model->id) ? __( 'Редактирование записи' ) : __( 'Создание записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'static-pages' => [
                'title'     => __( 'Статические страницы' ),
                'url'       => route('static-pages.index'),
                'active'    => false
            ],
            'static-pages-edit' => [
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

            @includeWhen($model->id, 'pages.static-pages.tabs', ['pages' => $model])

            @include( 'template-parts.pages-general-form', [
                'route' => ($model->id) ? 'static-pages.update' : 'static-pages.store',
                'pages' => ($model->id) ? $model->page : '',
                'model' => $model,
                'page_type'  => 3
            ] )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
