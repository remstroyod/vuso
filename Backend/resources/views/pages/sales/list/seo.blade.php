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
            'sales-list' => [
                'title'     => __( 'Список' ),
                'url'       => route('sales.list.index'),
                'active'    => false
            ],
            'sales-list-item' => [
                'title'     => $model->name,
                'url'       => route('sales.list.edit', $model),
                'active'    => false
            ],
            'sales-list-item-seo' => [
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

            @includeWhen($model->id, 'pages.sales.list.tabs', ['sales' => $model])

            @include('template-parts.seo', ['route' => route('sales.seo.list.update', ['sales' => $model, 'model' => 'Sales\\Sales'])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
