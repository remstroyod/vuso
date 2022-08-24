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
            'articles-list' => [
                'title'     => __( 'Список' ),
                'url'       => route('articles.list.index'),
                'active'    => false
            ],
            'articles-list-item' => [
                'title'     => $model->name,
                'url'       => route('articles.list.edit', $model),
                'active'    => false
            ],
            'articles-list-item-seo' => [
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

            @includeWhen($model->id, 'pages.articles.list.tabs', ['articles' => $model])

            @include('template-parts.seo', ['route' => route('articles.seo.list.update', ['articles' => $model, 'model' => 'Articles\\Articles'])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
