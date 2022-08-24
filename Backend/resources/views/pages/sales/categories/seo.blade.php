@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование SEO' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'sales' => [
                'title'     => __( 'Акции' ),
                'url'       => route('sales.edit'),
                'active'    => false
            ],
            'sales-categories' => [
                'title'     => __( 'Категории' ),
                'url'       => route('sales.categories.index'),
                'active'    => false
            ],
            'sales-categories-item' => [
                'title'     => $model->name,
                'url'       => route('sales.categories.edit', $model),
                'active'    => false
            ],
            'sales-categories-item-seo' => [
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

            @includeWhen($model->id, 'pages.sales.categories.tabs', ['categories' => $model])

            @include('template-parts.seo', ['route' => route('seo.categories.update', ['categories' => $model])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
