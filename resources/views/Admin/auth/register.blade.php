@extends('Admin.layouts.auth', ['title' => 'Register'])

@section('content')
    <div class="d-flex flex-column h-100 p-3">
        <div class="d-flex flex-column flex-grow-1">
            <div class="row h-100">
                <div class="col-xxl-7">
                    <div class="row justify-content-center h-100">
                        <div class="col-lg-6 py-lg-5">
                            <div class="d-flex flex-column h-100 justify-content-center">
                                <div class="auth-logo mb-4">
                                    <a href="{{ route('second', [ 'dashboards' , 'index']) }}" class="logo-dark">
                                        <img src="/assets/admin/images/logo-dark.png" height="24" alt="logo dark">
                                    </a>

                                    <a href="{{ route('second', [ 'dashboards' , 'index']) }}" class="logo-light">
                                        <img src="/assets/admin/images/logo-light.png" height="24" alt="logo light">
                                    </a>
                                </div>

                                <h2 class="fw-bold fs-24">Sign Up</h2>

                                <p class="text-muted mt-1 mb-4">New to our platform? Sign up now! It only takes a minute</p>

                                <div>
                                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="authentication-form">
                                        @csrf

                                        {{-- Name Field --}}
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Name</label>
                                            <input type="text" id="name" name="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   placeholder="Enter your name"
                                                   value="{{ old('name') }}"
                                                   required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Email Field --}}
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="email" name="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Enter your email"
                                                   value="{{ old('email') }}"
                                                   required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Phone Field --}}
                                        <div class="mb-3">
                                            <label class="form-label" for="phone">Phone (Optional)</label>
                                            <input type="text" id="phone" name="phone"
                                                   class="form-control @error('phone') is-invalid @enderror"
                                                   placeholder="Enter your phone number"
                                                   value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- User Type/Role Selection --}}
                                        <div class="mb-3">
                                            <label class="form-label" for="user_type">Register As</label>
                                            <select id="user_type" name="user_type"
                                                    class="form-select @error('user_type') is-invalid @enderror"
                                                    required>
                                                <option value="">Select Role</option>
                                                <option value="customer" {{ old('user_type') == 'customer' ? 'selected' : '' }}>Customer</option>
                                                <option value="restaurant_owner" {{ old('user_type') == 'restaurant_owner' ? 'selected' : '' }}>Restaurant Owner</option>
                                                {{-- Uncomment if you want to allow admin/moderator registration --}}
                                                {{-- <option value="moderator" {{ old('user_type') == 'moderator' ? 'selected' : '' }}>Moderator</option>
                                                <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option> --}}
                                            </select>
                                            @error('user_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Profile Image --}}
                                        <div class="mb-3">
                                            <label class="form-label" for="profile_image">Profile Image (Optional)</label>
                                            <input type="file" id="profile_image" name="profile_image"
                                                   class="form-control @error('profile_image') is-invalid @enderror"
                                                   accept="image/*">
                                            @error('profile_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Password Field --}}
                                        <div class="mb-3">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" name="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   placeholder="Enter your password"
                                                   required>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Confirm Password Field --}}
                                        <div class="mb-3">
                                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                   class="form-control"
                                                   placeholder="Confirm your password"
                                                   required>
                                        </div>

                                        {{-- Terms Checkbox --}}
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="terms" required>
                                                <label class="form-check-label" for="terms">
                                                    I accept Terms and Condition
                                                </label>
                                            </div>
                                        </div>

                                        {{-- Submit Button --}}
                                        <div class="mb-1 text-center d-grid">
                                            <button class="btn btn-soft-primary" type="submit">Sign Up</button>
                                        </div>
                                    </form>
                                </div>

                                <p class="mt-auto text-danger text-center">I already have an account
                                    <a href="{{ route('third', [ 'Admin','auth' , 'login']) }}" class="text-dark fw-bold ms-1">Login</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-5 d-none d-xxl-flex">
                    <div class="card h-100 mb-0 overflow-hidden">
                        <div class="d-flex flex-column h-100">
                            <img src="/assets/admin/images/small/img-10.jpg" alt="" class="w-100 h-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
