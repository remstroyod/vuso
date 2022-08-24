@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'catalog' => [
                'title'     => request()->routeIs('catalog.*') ? __( 'Каталог' ) : __( 'Каталог B2B' ),
                'url'       => request()->routeIs('catalog.edit') ? route('catalog.edit', $model) : route('b2b.edit', $model),
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

            @includeWhen($model->id, 'pages.catalog.tabs', ['pages' => $model])

            @include( 'template-parts.pages-general-form', [
                'route' => request()->routeIs('catalog.*') ? 'catalog.update' : 'b2b.update',
                'page' => $model->page,
                'model' => $model
            ] )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
