@extends('auth.master.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="px-2 py-3">
                <div class="text-center">
                    <a href="index.php">
                        <img src="assets/images/logo-dark.png" height="20" alt="logo">
                    </a>
                    <h5 class="text-primary  my-2">{{ __('Login') }}</h5>
                </div>
                <form class="form-horizontal mt-2 pt-2" action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input autocomplete="off" type="email" class="form-control  @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" name="email" placeholder="Enter email" required
                            autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="mb-3">
                        <label for="userpassword">Password:</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary w-100 waves-effect waves-light"
                            type="submit">{{ __('Login') }}</button>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-6">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="fw-bold"><i
                                        class="mdi mdi-lock me-1"></i>
                                    {{ __('Forgot Password?') }}</a>
                            @endif
                        </div>

                        <div class="col-6">
                            <p>{{ __("Don't have an account") }} ? <a href="{{ route('register') }}"
                                    class="fw-bold">
                                    {{ __('Register') }}
                                </a> </p>
                        </div>
                    </div>
                    <div class="mt-4 text-center">

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
