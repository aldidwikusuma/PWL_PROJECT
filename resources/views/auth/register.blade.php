@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5 text-center">
                            <div class="col-md-12 p-0 mb-5">
                                <h1 class="h4 text-gray-900">Create an Account</h1>
                            </div>
                            <form class="user p-0" method="post" action="{{ route('register') }}">
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

                                <div class="mb-3 text-left">
                                    <label for="email" class="col-form-label pl-0">Email Address</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3 text-left">
                                    <label for="password" class="col-form-label pl-0">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required >
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <p>{{ $message }}</p>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-4 text-left">
                                    <label for="password-confirm" class="col-form-label pl-0">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>

                                <div class="mb-0">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </form>
                            <hr>
                            @if (Route::has('password.request'))
                                <div class="mb-1">
                                    <a class="py-1 px-3" href="{{ route('password.request') }}">
                                        Forget Password
                                    </a>
                                </div>
                            @endif

                            <div class="mb-1">
                                <a class="py-1 px-3" href="{{ route('login') }}">
                                    Already have an account? Login here
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection