@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование SEO' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'catalog' => [
                'title'     => request()->routeIs('catalog.*') ? __( 'Каталог' ) : __( 'Каталог B2B' ),
                'url'       => request()->routeIs('catalog.*') ? route('catalog.edit') : route('b2b.edit'),
                'active'    => false
            ],
            'catalog-products' => [
                'title'     => __( 'Продукты' ),
                'url'       => request()->routeIs('catalog.*') ? route('catalog.products.index') : route('b2b.products.index'),
                'active'    => false
            ],
            'catalog-products-item' => [
                'title'     => $model->name,
                'url'       => request()->routeIs('catalog.*') ? route('catalog.products.edit', $model) : route('b2b.products.edit', $model),
                'active'    => false
            ],
            'catalog-products-item-seo' => [
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

            @includeWhen($model->id, 'pages.catalog.products.tabs', ['product' => $model])

            @include('template-parts.seo', ['route' => route('catalog.seo.products.update', ['product' => $model, 'model' => 'Catalog\\Product'])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
