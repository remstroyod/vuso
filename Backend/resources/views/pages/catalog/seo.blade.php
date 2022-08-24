@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование SEO' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'catalog' => [
                'title'     => request()->routeIs('catalog.*') ? __( 'Каталог' ) : __( 'Каталог B2B' ),
                'url'       => request()->routeIs('catalog.edit') ? route('catalog.edit', $model) : route('b2b.edit', $model),
                'active'    => false
            ],
            'catalog-seo' => [
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

            @includeWhen($model->id, 'pages.catalog.tabs', ['pages' => $model])

            @include('template-parts.seo', [
                'route' => request()->routeIs('catalog.*') ? route('catalog.seo.update', ['pages' => $model]) : route('b2b.seo.update', ['pages' => $model])
            ])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
