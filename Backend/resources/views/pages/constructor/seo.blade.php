@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование SEO' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'constructor' => [
                'title'     => __( 'Конструктор' ),
                'url'       => route('constructor.index'),
                'active'    => false
            ],
            'constructor-edit' => [
                'title'     => $model->name,
                'url'       => route('constructor.edit', $model),
                'active'    => false
            ],
            'constructor-record' => [
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

            @includeWhen($model->id, 'pages.constructor.tabs')

            @include('template-parts.seo', ['route' => route('constructor.seo.update', ['pages' => $model, 'page' => $model]), 'constructor' => true])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
