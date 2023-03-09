@extends('layouts.app')
@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
            <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">{{ __('Register') }}</h1>
            </div>
            <div class="col-lg-6 text-lg-end">

            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="row">
        <div class="col-6 offset-3">
            <h2 class="h5 text-uppercase mb-4">{{ __('Register') }}</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-small text-uppercase" for="first_name">First Name</label>
                            <input class="form-control @error('first_name') is-invalid @enderror form-control-lg"
                                name="first_name" type="text" value="{{ old('first_name') }}"
                                placeholder="Enter your First Name" required>
                            @error('first_name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-small text-uppercase" for="last_name">Last Name</label>
                            <input class="form-control @error('last_name') is-invalid @enderror form-control-lg"
                                name="last_name" type="text" value="{{ old('last_name') }}"
                                placeholder="Enter your Last Name" required>
                            @error('last_name') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-small text-uppercase" for="username">Username</label>
                            <input class="form-control @error('username') is-invalid @enderror form-control-lg"
                                name="username" type="text" value="{{ old('username') }}"
                                placeholder="Enter your Username" required>
                            @error('username') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-small text-uppercase" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror form-control-lg"
                                name="email" type="email" value="{{ old('email') }}" placeholder="Enter your Email"
                                required>
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-small text-uppercase" for="mobile">Mobile Number</label>
                            <input class="form-control @error('mobile') is-invalid @enderror form-control-lg"
                                name="mobile" type="text" value="{{ old('mobile') }}" placeholder="Enter your Mobile"
                                required>
                            @error('mobile') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-small text-uppercase" for="password">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror form-control-lg"
                                name="password" type="password" placeholder="Enter your Password" required>
                            @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-small text-uppercase" for="password_confirmation">Password</label>
                            <input
                                class="form-control @error('password_confirmation') is-invalid @enderror form-control-lg"
                                name="password_confirmation" type="password" placeholder="Re type your Password"
                                required>
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-dark" type="submit">{{ __('Register') }}</button>
                            @if (Route::has('login'))
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ __('Have an account?') }}
                            </a>
                            @endif
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>
@endsection