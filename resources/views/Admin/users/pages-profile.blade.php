@extends('Admin.layouts.vertical', ['title' => 'Profile'])

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-xl-9 col-lg-8">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="bg-primary profile-bg rounded-top position-relative mx-n3 mt-n3">
                    @if($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}"
                             class="avatar-xl border border-light border-3 rounded-circle position-absolute top-100 start-0 translate-middle ms-5">
                    @else
                        <img src="/images/users/avatar-1.jpg" alt="Default Avatar"
                             class="avatar-xl border border-light border-3 rounded-circle position-absolute top-100 start-0 translate-middle ms-5">
                    @endif
                </div>
                <div class="mt-5 d-flex flex-wrap align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-1">
                            {{ $user->name }}
                            @if($user->status === 'active')
                                <i class='bx bxs-badge-check text-success align-middle'></i>
                            @endif
                        </h4>
                        <p class="mb-0">{{ ucfirst(str_replace('_', ' ', $user->user_type)) }}</p>
                    </div>
                    <div class="d-flex align-items-center gap-2 my-2 my-lg-0">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                            <i class='bx bx-edit'></i> Edit Profile
                        </a>
                    </div>
                </div>
                <div class="row mt-3 gy-2">
                    <div class="col-lg-4 col-6">
                        <div class="d-flex align-items-center gap-2 border-end">
                            <div class="">
                                <iconify-icon icon="solar:user-id-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                            </div>
                            <div>
                                <h5 class="mb-1">{{ ucfirst(str_replace('_', ' ', $user->user_type)) }}</h5>
                                <p class="mb-0">Role</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="d-flex align-items-center gap-2 border-end">
                            <div class="">
                                <iconify-icon icon="solar:calendar-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                            </div>
                            <div>
                                <h5 class="mb-1">{{ $user->created_at->format('M Y') }}</h5>
                                <p class="mb-0">Member Since</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-6">
                        <div class="d-flex align-items-center gap-2">
                            <div class="">
                                <iconify-icon icon="solar:clock-circle-bold-duotone" class="fs-28 text-primary"></iconify-icon>
                            </div>
                            <div>
                                <h5 class="mb-1">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}</h5>
                                <p class="mb-0">Last Login</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Personal Information</h4>
            </div>
            <div class="card-body">
                <div class="">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:user-id-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">{{ ucfirst(str_replace('_', ' ', $user->user_type)) }}</p>
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:letter-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">{{ $user->email }}</p>
                    </div>

                    @if($user->phone)
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:phone-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">{{ $user->phone }}</p>
                    </div>
                    @endif

                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:calendar-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">Joined {{ $user->created_at->format('F d, Y') }}</p>
                    </div>

                    @if($user->email_verified_at)
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:shield-check-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">Email Verified</p>
                    </div>
                    @endif

                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:check-circle-bold-duotone" class="fs-20 text-secondary"></iconify-icon>
                        </div>
                        <p class="mb-0 fs-14">Status
                            <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}-subtle text-{{ $user->status === 'active' ? 'success' : 'danger' }} ms-1">
                                {{ ucfirst($user->status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($user->hasRole('restaurant_owner'))
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">My Restaurants</h4>
            </div>
            <div class="card-body">
                @if($user->restaurants->count() > 0)
                    <div class="row">
                        @foreach($user->restaurants as $restaurant)
                            <div class="col-md-6 col-lg-4">
                                <div class="border p-3 rounded mb-3">
                                    <h5>{{ $restaurant->name }}</h5>
                                    <p class="text-muted mb-0">{{ $restaurant->address }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No restaurants added yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif

@endsection
