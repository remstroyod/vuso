@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование SEO' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'static-pages' => [
                'title'     => __( 'Статические страницы' ),
                'url'       => route('static-pages.index'),
                'active'    => false
            ],
            'static-pages-edit' => [
                'title'     => $model->name,
                'url'       => route('static-pages.edit', $model),
                'active'    => false
            ],
            'static-pages-record' => [
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

            @include('template-parts.seo', ['route' => route('static-pages.seo.update', ['pages' => $model, 'page' => $model])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
