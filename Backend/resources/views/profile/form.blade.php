@extends('layouts.app')

@section('content')

    @php( $title = __( 'Редактирование профиля' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'profile' => [
                'title'     => __( 'Профиль' ),
                'url'       => route('users.profile.edit'),
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

            @include('profile.tabs')

            @include( 'profile.general.form', ['user' => $user] )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
