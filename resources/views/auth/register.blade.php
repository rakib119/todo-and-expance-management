@extends('auth.master.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="px-2 py-3">
                <div class="text-center">
                    <a href="index.html">
                        <img src="assets/images/logo-dark.png" height="22" alt="logo">
                    </a>
                    <h5 class="text-primary mb-2 mt-4">{{ __('Register') }}</h5>
                    <p class="text-muted">{{ __('For register please fill up this form') }}
                    </p>
                </div>
                <form class="form-horizontal" method="POST"  action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">

                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">
                            {{ __('Register') }}</button>
                    </div>

                </form>
                <div class="mt-4 row">

                    <p>{{ __('Already have an account') }} ? <a href="{{ route('login') }}" class="fw-bold">
                            {{ __('Login ') }}
                        </a> </p>
                </div>
            </div>
        </div>
    </div>
@endsection
