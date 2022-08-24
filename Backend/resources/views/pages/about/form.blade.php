@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'about' => [
                'title'     => __( 'О компании' ),
                'url'       => route('about.edit', $model),
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

            @includeWhen($model->id, 'pages.about.tabs', ['pages' => $model])

            @include( 'template-parts.pages-general-form', ['route' => 'about.update', 'page' => 'about', 'model' => $model] )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
