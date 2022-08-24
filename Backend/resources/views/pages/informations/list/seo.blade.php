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
            'informations-list' => [
                'title'     => __( 'Список' ),
                'url'       => route('informations.list.index'),
                'active'    => false
            ],
            'informations-list-item' => [
                'title'     => $model->name,
                'url'       => route('informations.list.edit', $model),
                'active'    => false
            ],
            'informations-list-item-seo' => [
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

            @includeWhen($model->id, 'pages.informations.list.tabs', ['informations' => $model])

            @include('template-parts.seo', ['route' => route('informations.seo.list.update', ['informations' => $model])])

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
