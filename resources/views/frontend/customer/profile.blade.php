@extends('layouts.app')
@section('content')

    <!-- HERO SECTION -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">{{ auth()->user()->full_name }} Profile</h1>
                </div>
                <div class="col-lg-6 text-lg-right">
                    <div aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customer.profile') }}">Profile</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="row">
            <div class="col-lg-8 pt-2">
                <form action="{{ route('customer.update_profile') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-lg-12 text-center mb-4">
                            @if (auth()->user()->user_image != '')
                                <img src="{{ asset('assets/users/' . auth()->user()->user_image) }}" alt="{{ auth()->user()->full_name }}" class="img-thumbnail" width="120">
                                <div class="mt-2">
                                    <a href="{{ route('customer.remove_profile_image') }}" class="btn btn-sm btn-outline-danger">Remove image</a>
                                </div>
                            @else
                                <img src="{{ asset('assets/users/avatar.svg') }}" alt="{{ auth()->user()->full_name }}" class="img-thumbnail" width="120">
                            @endif
                        </div>
                        <div class="col-lg-6 form-group mt-3">
                            <label class="text-small text-uppercase" for="first_name">First name</label>
                            <input class="form-control form-control-lg" name="first_name" type="text" value="{{ old('first_name', auth()->user()->first_name) }}" placeholder="Enter your first name">
                            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6 form-group mt-3">
                            <label class="text-small text-uppercase" for="last_name">Last name</label>
                            <input class="form-control form-control-lg" name="last_name" type="text" value="{{ old('last_name', auth()->user()->last_name) }}" placeholder="Enter your last name">
                            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6 form-group mt-3">
                            <label class="text-small text-uppercase" for="email">Email</label>
                            <input class="form-control form-control-lg" name="email" type="text" value="{{ old('email', auth()->user()->email) }}" placeholder="e.g. Jason@example.com">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6 form-group mt-3">
                            <label class="text-small text-uppercase" for="mobile">Mobile</label>
                            <input class="form-control form-control-lg" name="mobile" type="text" value="{{ old('mobile', auth()->user()->mobile) }}" placeholder="e.g. 966512345678">
                            @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6 form-group mt-3">
                            <label class="text-small text-uppercase" for="password">Password<small class="ml-auto text-danger">(Optional)</small></label>
                            <input class="form-control form-control-lg" name="password" type="password">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-6 form-group mt-3">
                            <label class="text-small text-uppercase" for="password">Re-Password<small class="ml-auto text-danger">(Optional)</small></label>
                            <input class="form-control form-control-lg" name="password_confirmation" type="password">
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-12 form-group mt-3">
                            <label class="text-small text-uppercase" for="user_image">Image</label>
                            <input class="form-control form-control-lg" name="user_image" type="file">
                            @error('user_image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-lg-12 form-group mt-3">
                            <button class="btn btn-dark" type="submit">Update profile</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- SIDEBAR -->
            <div class="col-lg-4">
                @include('partial.frontend.customer.sidebar')
            </div>
        </div>
    </section>
@endsection