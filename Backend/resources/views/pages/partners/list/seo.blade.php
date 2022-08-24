@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование SEO' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'partners' => [
                'title'     => __( 'Партнеры' ),
                'url'       => route('partners.edit'),
                'active'    => false
            ],
            'partners-list' => [
                'title'     => __( 'Список' ),
                'url'       => route('partners.list.index'),
                'active'    => false
            ],
            'partners-list-item' => [
                'title'     => $model->name,
                'url'       => route('partners.list.edit', $model),
                'active'    => false
            ],
            'partners-list-item-seo' => [
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

            @includeWhen($model->id, 'pages.partners.list.tabs', ['partners' => $model])

            @include('template-parts.seo', ['route' => route('partners.seo.list.update', ['partners' => $model])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
