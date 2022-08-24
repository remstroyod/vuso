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
            'sales-record' => [
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

            @includeWhen($model->id, 'pages.sales.tabs', ['pages' => $model])

            @include('template-parts.seo', ['route' => route('sales.seo.update', ['pages' => $model])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
