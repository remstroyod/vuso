@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'informations' => [
                'title'     => __( 'Информация' ),
                'url'       => route('informations.edit', $model),
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

            @includeWhen($model->id, 'pages.informations.tabs', ['pages' => $model])

            @include( 'template-parts.pages-general-form', ['route' => 'informations.update', 'page' => 'informations', 'model' => $model] )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
