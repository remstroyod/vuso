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
            'reviews-list' => [
                'title'     => __( 'Список' ),
                'url'       => route('reviews.list.index'),
                'active'    => false
            ],
            'reviews-list-item' => [
                'title'     => $model->name,
                'url'       => route('reviews.list.edit', $model),
                'active'    => false
            ],
            'reviews-list-item-seo' => [
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

            @includeWhen($model->id, 'pages.reviews.list.tabs', ['reviews' => $model])

            @include('template-parts.seo', ['route' => route('reviews.seo.list.update', ['reviews' => $model, 'model' => 'Reviews'])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
