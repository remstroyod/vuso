@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'payment-delivery' => [
                'title'     => __( 'Оплата и доставка' ),
                'url'       => route('payment_delivery.edit', $model),
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

            @include( 'template-parts.pages-general-form', ['route' => 'payment_delivery.update', 'page' => 'payment_delivery', 'model' => $model] )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
