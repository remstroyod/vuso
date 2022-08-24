@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование SEO' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'reviews' => [
                'title'     => __( 'Отзывы' ),
                'url'       => route('reviews.edit'),
                'active'    => false
            ],
            'reviews-record' => [
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

            @includeWhen($model->id, 'pages.reviews.tabs', ['pages' => $model])

            @include('template-parts.seo', ['route' => route('reviews.seo.update', ['pages' => $model])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
