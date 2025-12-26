@extends('Admin.layouts.auth', ['title' => 'Forgot Password'])

@section('content')
    <div class="d-flex flex-column h-100 p-3">
        <div class="d-flex flex-column flex-grow-1">
            <div class="row h-100">
                <div class="col-xxl-7">
                    <div class="row justify-content-center h-100">
                        <div class="col-lg-6 py-lg-5">
                            <div class="d-flex flex-column h-100 justify-content-center">
                                <div class="auth-logo mb-4">
                                    <a href="{{ route('second', ['dashboards', 'index']) }}" class="logo-dark">
                                        <img src="/assets/admin/images/logo-dark.png" height="24" alt="logo dark">
                                    </a>

                                    <a href="{{ route('second', ['dashboards', 'index']) }}" class="logo-light">
                                        <img src="/assets/admin/images/logo-light.png" height="24" alt="logo light">
                                    </a>
                                </div>

                                <h2 class="fw-bold fs-24">Forgot Password?</h2>
                                <p class="text-muted mt-1 mb-4">
                                    Enter your email address and we'll send you a link to reset your password.
                                </p>

                                {{-- Success Message --}}
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div>
                                    <form action="{{ route('password.email') }}" method="POST" class="authentication-form">
                                        @csrf

                                        {{-- Email Field --}}
                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email Address</label>
                                            <input type="email"
                                                   id="email"
                                                   name="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Enter your email"
                                                   value="{{ old('email') }}"
                                                   required
                                                   autofocus>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Submit Button --}}
                                        <div class="mb-1 text-center d-grid">
                                            <button class="btn btn-primary" type="submit">
                                                Send Reset Link
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <p class="mt-auto text-danger text-center">
                                    Remember your password?
                                    <a href="{{ route('login') }}" class="text-dark fw-bold ms-1">Login</a>
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
