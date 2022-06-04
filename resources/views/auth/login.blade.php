@extends('layouts.app')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6 text-center">
                                <div class="py-5 px-4">
                                    <div class="mb-3">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome to Our Bioskop</h1>
                                    </div>

                                    <div class="mb-3 py-1 px-2" >
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="mb-3 text-left">
                                                <label for="username" class="col-form-label pl-0">Username</label>
                                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <p>{{ $message }}</p>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-4 text-left">
                                                <label for="password" class="col-form-label pl-0">Password</label>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <p>{{ $message }}</p>
                                                    </span>
                                                @enderror
                                                
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="remember">
                                                        Remember Me
                                                    <label>           
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary px-4">
                                                    Login
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <hr>
                                    @if (Route::has('password.request'))
                                        <div class="mb-1">
                                            <a class="py-1 px-3" href="{{ route('password.request') }}">
                                                Forget Password
                                            </a>
                                        </div>
                                    @endif

                                    <div class="mb-1">
                                        <a class="py-1 px-3" href="{{ route('register') }}">
                                            Don't have account, register here
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection