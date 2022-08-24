@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование SEO' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'catalog' => [
                'title'     => request()->routeIs('catalog.categories.*') ? __( 'Каталог' ) : __( 'Каталог B2B' ),
                'url'       => request()->routeIs('catalog.categories.*') ? route('catalog.edit') : route('b2b.edit'),
                'active'    => false
            ],
            'catalog-categories' => [
                'title'     => __( 'Категории' ),
                'url'       => request()->routeIs('catalog.categories.*') ? route('catalog.categories.index') : route('b2b.categories.index'),
                'active'    => false
            ],
            'catalog-categories-item' => [
                'title'     => $model->name,
                'url'       => request()->routeIs('catalog.categories.*') ? route('catalog.categories.edit', $model) : route('b2b.categories.edit', $model),
                'active'    => false
            ],
            'catalog-categories-item-seo' => [
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

            @includeWhen($model->id, 'pages.catalog.categories.tabs', ['category' => $model])

            @include('template-parts.seo', [
                'route' => request()->routeIs('catalog.categories.*') ? route('catalog.seo.categories.update', ['category' => $model, 'model' => 'Catalog\\Category']) : route('b2b.seo.categories.update', ['category' => $model, 'model' => 'Catalog\\Category'])
            ])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
