@extends('layouts.app')

@section('content')

    @php( $title = __( 'Смена пароля' ) )

    @include('template-parts.breadcrumbs', [
        'breadcrumbsList' => [
            'profile' => [
                'title'     => __( 'Профиль' ),
                'url'       => route('users.profile.edit'),
                'active'    => false
            ],
            'profile-password' => [
                'title'     => __( 'Изменить пароль' ),
                'url'       => '',
                'active'    => true
            ]
        ]
    ])

    <!-- Row -->
    <div class="row">

        <!-- Col -->
        <div class="col-md-12 grid-margin">

            <!-- Title -->
            <h4 class="card-title">
                {{ $title }}
            </h4>
            <!-- End Title -->

            @include('template-parts.message')

            @include('profile.tabs')

            <!-- Form -->
            <form action="{{ route('users.profile.password.update') }}" method="post" enctype="multipart/form-data">
            @csrf

                <!-- card -->
                <div class="card">

                    <!-- card-body -->
                    <div class="card-body">

                        <!-- Title -->
                        <h4 class="card-title">
                            {{ $title }}
                        </h4>
                        <!-- End Title -->

                        <!-- Row -->
                        <div class="row mb-3">

                            <!-- Col -->
                            <div class="col-lg-6">

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="password">
                                        {{ __( 'Новый пароль' ) }}
                                    </label>
                                    {!! html_input('password', 'password', '', ['class' => 'form-control', 'id' => 'password']) !!}
                                </div>
                                <!-- end form group -->

                            </div>
                            <!-- End Col -->

                            <!-- Col -->
                            <div class="col-lg-6">

                                <!-- form group -->
                                <div class="form-group">
                                    <label for="password_confirmation">
                                        {{ __( 'Повторите новый пароль' ) }}
                                    </label>
                                    {!! html_input('password', 'password_confirmation', '', ['class' => 'form-control', 'id' => 'password_confirmation']) !!}
                                </div>
                                <!-- end form group -->

                            </div>
                            <!-- End Col -->

                        </div>
                        <!-- End Row -->

                        <!-- fieldset -->
                        <fieldset>
                            <button type="submit" class="btn btn-primary">
                                {{ __( 'Сохранить' ) }}
                            </button>
                            <a href="{{ route('users.profile.edit') }}" type="button" class="btn btn-secondary">
                                {{ __( 'Отмена' ) }}
                            </a>
                        </fieldset>
                        <!-- end fieldset -->

                    </div>
                    <!-- end card-body -->

                </div>
                <!-- end card -->

            </form>
            <!-- End Form -->

        </div>
        <!-- End Col -->

    </div>
    <!-- End Row -->

@endsection
