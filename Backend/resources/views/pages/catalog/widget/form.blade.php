@extends('layouts.app')

@section('content')

    @php( $title = __( 'Сценарий' ) )

    @include('template-parts.breadcrumbs', [
            'breadcrumbsList' => [
                'catalog' => [
                    'title'     => __( 'Каталог' ),
                    'url'       => route('catalog.edit'),
                    'active'    => false,
                ],
                'catalog-widget' => [
                    'title'     => __( 'Продукты' ),
                    'url'       => route('catalog.products.index'),
                    'active'    => false,
                ],
                'catalog-products-product' => [
                    'title'     => $product->name,
                    'url'       => route('catalog.products.edit', $product),
                    'active'    => false,
                ],
                'catalog-products-product-widget' => [
                    'title'     => __( 'Widget' ),
                    'url'       => '',
                    'active'    => true,
                ],
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

            @includeWhen($product, 'pages.catalog.products.tabs', ['product' => $product, 'model' => $page])

            <!-- stretch -->
            <div class="stretch-card">

                <!-- card -->
                <div class="card">

                    <!-- card-body -->
                    <div class="card-body">

                        <iframe src="{{ asset('widget/index.html?product=' . $product->id . '&lang=') . app()->getLocale() }}" frameborder="0" width="100%" height="768"></iframe>

                    </div>
                    <!-- end card-body -->

                </div>
                <!-- end card -->

            </div>
            <!-- end stretch -->

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
