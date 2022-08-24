@extends('layouts.app-guest')

@section('content')

    <!-- Container -->
    <div class="page-content d-flex align-items-center justify-content-center">

        <!-- row -->
        <div class="row w-100 mx-0 auth-page">

            <!-- col -->
            <div class="col-md-8 col-xl-6 mx-auto">

                <!-- card -->
                <div class="card">

                    <!-- row -->
                    <div class="row">

                        <!-- col -->
                        <div class="col-md-4 pr-md-0">
                            <div class="auth-left-wrapper" style="background-image: url({{ asset('assets/images/auth/login-form-background.jpg') }}); background-position: center center">

                            </div>
                        </div>
                        <!-- end col -->

                        <!-- col -->
                        <div class="col-md-8 pl-md-0">

                            <!-- wrapper -->
                            <div class="auth-form-wrapper px-4 py-5">

                                <!-- Logo -->
                                <a href="{{ route('dashboard') }}" class="noble-ui-logo d-block mb-2">
                                    <img
                                            src="{{ asset('assets/images/logo.svg') }}"
                                            alt="{{ __( 'Vuso' ) }}"
                                            title="{{ __( 'Vuso' ) }}"
                                    >
                                </a>
                                <!-- End Logo -->

                                <!-- Title -->
                                <h5 class="text-muted font-weight-normal mb-4">
                                    {{ __( 'Добро пожаловать! Войдите в свою учетную запись.' ) }}
                                </h5>
                                <!-- End Title -->

                                <!-- Form -->
                                <form method="POST" action="{{ route('login') }}" class="forms-sample">
                                    @csrf

                                    <!-- group -->
                                    <div class="form-group">

                                        <label for="email">
                                            {{ __('E-Mail') }}
                                        </label>

                                        <input
                                                id="email"
                                                type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                name="email"
                                                value="{{ old('email') }}"
                                                required
                                                autocomplete="email"
                                                autofocus
                                        >

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                    <!-- end group -->

                                    <!-- group -->
                                    <div class="form-group">

                                        <label for="password">
                                            {{ __('Пароль') }}
                                        </label>

                                        <input
                                                id="password"
                                                type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password"
                                                required
                                                autocomplete="current-password"
                                        >

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <!-- end group -->

                                    <!-- check -->
                                    <div class="form-check form-check-flat form-check-primary">
                                        <label class="form-check-label" for="remember">
                                            <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    name="remember"
                                                    id="remember"
                                                    {{ old('remember') ? 'checked' : '' }}
                                            >
                                            {{ __('Запомнить меня') }}
                                        </label>
                                    </div>
                                    <!-- end check -->

                                    <!-- group -->
                                    <div class="mt-3">

                                        <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                                            {{ __('Войти') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0" href="{{ route('password.request') }}">
                                                {{ __('Забыли пароль?') }}
                                            </a>
                                        @endif

                                    </div>
                                    <!-- end group -->

                                </form>
                                <!-- End Form -->

                            </div>
                            <!-- end wrapper -->

                        </div>
                        <!-- end col -->

                    </div>
                    <!-- end row -->

                </div>
                <!-- end card -->

            </div>
            <!-- end col -->

        </div>
        <!-- end row -->

    </div>
    <!-- End Container -->

@endsection
