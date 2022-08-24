@extends('layouts.app')

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

                        </div>
                        <!-- end col -->

                        <!-- col -->
                        <div class="col-md-8 pl-md-0">

                            <!-- wrapper -->
                            <div class="auth-form-wrapper px-4 py-5">

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



                                    <!-- group -->
                                    <div class="mt-3">

                                        <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">
                                            {{ __('Войти') }}
                                        </button>


                                        <a class="btn btn-facebook" href="{{ url('/auth/facebook') }}"><i class="fa fa-facebook"></i> Facebook</a>

                                        {!! Socialite::driver('telegram')->getButton() !!}

                                        <a class="btn btn-google" href="{{ url('/auth/google') }}"><i class="fa fa-google"></i> Google</a>

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

@push('custom-scripts')

    <script>
        jQuery( function( $ ) {


        });
    </script>

@endpush
