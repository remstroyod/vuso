@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование SEO' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'partners' => [
                'title'     => __( 'Партнеры' ),
                'url'       => route('partners.edit'),
                'active'    => false
            ],
            'partners-categories' => [
                'title'     => __( 'Категории' ),
                'url'       => route('partners.categories.index'),
                'active'    => false
            ],
            'partners-categories-item' => [
                'title'     => $model->name,
                'url'       => route('partners.categories.edit', $model),
                'active'    => false
            ],
            'partners-categories-item-seo' => [
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

            @includeWhen($model->id, 'pages.partners.categories.tabs', ['categories' => $model])

            @include('template-parts.seo', ['route' => route('seo.categories.update', ['categories' => $model])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
