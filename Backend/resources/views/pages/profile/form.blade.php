@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование записи' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'profile' => [
                'title'     => __( 'Поддержка' ),
                'url'       => route('profile.edit', $model),
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

            @includeWhen($model->id, 'pages.profile.tabs', ['pages' => $model])

            @include( 'template-parts.pages-general-form', ['route' => 'profile.update', 'page' => 'profile', 'model' => $model] )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
