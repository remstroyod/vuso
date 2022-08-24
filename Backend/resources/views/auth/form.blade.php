@extends('layouts.layout')

@section('content')
    <div class="main-wrapper">
        <form action="{{route('auth.login')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" autocomplete="current-password" placeholder="Пароль">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                @enderror
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

        </form>
    </div>
@endsection
