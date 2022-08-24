@extends('layouts.app')

@section('content')

    @php( $title = (isset($user)) ? __( 'Редактирование пользователя' ) : __( 'Регистрация пользователя' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'users' => [
                'title'     => __( 'Пользователи' ),
                'url'       => route('users.list.index'),
                'active'    => false
            ],
            'users-edit' => [
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

            @include('users.tabs')

            <!-- Form -->
            <form action="{{ (isset($user)) ? route('users.list.update', $user) : route('users.list.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @include( 'template-parts.user.form' )

            </form>
            <!-- End Form -->

            @include( 'template-parts.editor' )

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
