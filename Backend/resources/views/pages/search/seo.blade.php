@extends('layouts.app')

@section('content')

    @php( $title = __( 'Результаты поиска' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'static-page' => [
                'title'     => __( 'Все страницы' ),
                'url'       => route('static-pages.index'),
                'active'    => false
            ],
            'search' => [
                'title'     => __( 'Результаты поиска' ),
                'url'       => route('search.edit'),
                'active'    => false
            ],
            'search-record' => [
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

            @includeWhen($model->id, 'pages.search.tabs', ['pages' => $model])

            @include('template-parts.seo', ['route' => route('search.seo.update', ['pages' => $model])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
