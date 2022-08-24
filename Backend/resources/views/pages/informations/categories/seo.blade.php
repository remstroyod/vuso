@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование SEO' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'informations' => [
                'title'     => __( 'Информация' ),
                'url'       => route('informations.edit'),
                'active'    => false
            ],
            'informations-categories' => [
                'title'     => __( 'Категории' ),
                'url'       => route('informations.categories.index'),
                'active'    => false
            ],
            'informations-categories-item' => [
                'title'     => $model->name,
                'url'       => route('informations.categories.edit', $model),
                'active'    => false
            ],
            'informations-categories-item-seo' => [
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

            @includeWhen($model->id, 'pages.informations.categories.tabs', ['categories' => $model])

            @include('template-parts.seo', ['route' => route('seo.categories.update', ['categories' => $model])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
