@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование SEO' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'payment-delivery' => [
                'title'     => __( 'Оплата и доставка' ),
                'url'       => route('payment_delivery.edit'),
                'active'    => false
            ],
            'payment-delivery-record' => [
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

            @includeWhen($model->id, 'pages.payment_delivery.tabs', ['pages' => $model])

            @include('template-parts.seo', ['route' => route('payment_delivery.seo.update', ['pages' => $model])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
