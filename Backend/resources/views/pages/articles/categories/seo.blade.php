@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование SEO' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'articles' => [
                'title'     => __( 'Новости и статьи' ),
                'url'       => route('articles.edit'),
                'active'    => false
            ],
            'articles-categories' => [
                'title'     => __( 'Категории' ),
                'url'       => route('articles.categories.index'),
                'active'    => false
            ],
            'articles-categories-item' => [
                'title'     => $model->name,
                'url'       => route('articles.categories.edit', $model),
                'active'    => false
            ],
            'articles-categories-item-seo' => [
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

            @includeWhen($model->id, 'pages.articles.categories.tabs', ['categories' => $model])

            @include('template-parts.seo', ['route' => route('seo.categories.update', ['categories' => $model, 'model' => 'Articles\\Categories'])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
