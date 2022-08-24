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
            'payment-delivery-categories' => [
                'title'     => __( 'Категории' ),
                'url'       => route('payment_delivery.categories.index'),
                'active'    => false
            ],
            'payment-delivery-categories-item' => [
                'title'     => $model->name,
                'url'       => route('payment_delivery.categories.edit', $model),
                'active'    => false
            ],
            'payment-delivery-categories-item-seo' => [
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

            @includeWhen($model->id, 'pages.payment_delivery.categories.tabs', ['categories' => $model])

            @include('template-parts.seo', ['route' => route('seo.categories.update', ['categories' => $model])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
