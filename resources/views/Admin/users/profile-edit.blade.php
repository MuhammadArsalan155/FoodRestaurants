@extends('Admin.layouts.vertical', ['title' => 'Edit Profile'])

@section('content')

<div class="row">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Profile</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Profile Image Section --}}
                    <div class="mb-4">
                        <label class="form-label">Profile Image</label>
                        <div class="d-flex align-items-center gap-3">
                            @if($user->profile_image)
                                <img src="{{ asset('storage/' . $user->profile_image) }}"
                                     alt="{{ $user->name }}"
                                     class="avatar-lg rounded-circle border"
                                     id="profile-preview">
                            @else
                                <img src="/images/users/avatar-1.jpg"
                                     alt="Default Avatar"
                                     class="avatar-lg rounded-circle border"
                                     id="profile-preview">
                            @endif
                            <div>
                                <input type="file"
                                       class="form-control @error('profile_image') is-invalid @enderror"
                                       id="profile_image"
                                       name="profile_image"
                                       accept="image/*"
                                       onchange="previewImage(event)">
                                <small class="text-muted">Max file size: 2MB. Allowed: JPG, PNG, GIF</small>
                                @error('profile_image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @if($user->profile_image)
                            <button type="button"
                                    class="btn btn-sm btn-danger mt-2"
                                    onclick="deleteProfileImage()">
                                <i class='bx bx-trash'></i> Remove Image
                            </button>
                        @endif
                    </div>

                    <hr>

                    {{-- Basic Information --}}
                    <h5 class="mb-3">Basic Information</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   id="phone"
                                   name="phone"
                                   value="{{ old('phone', $user->phone) }}"
                                   placeholder="+1 234 567 8900">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Email (Read Only) --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email"
                               class="form-control"
                               id="email"
                               value="{{ $user->email }}"
                               readonly
                               disabled>
                        <small class="text-muted">Email cannot be changed</small>
                    </div>

                    {{-- User Type (Read Only) --}}
                    <div class="mb-3">
                        <label for="user_type" class="form-label">Account Type</label>
                        <input type="text"
                               class="form-control"
                               id="user_type"
                               value="{{ ucfirst(str_replace('_', ' ', $user->user_type)) }}"
                               readonly
                               disabled>
                        <small class="text-muted">Account type cannot be changed</small>
                    </div>

                    <hr>

                    {{-- Change Password Section --}}
                    <h5 class="mb-3">Change Password (Optional)</h5>
                    <p class="text-muted">Leave blank if you don't want to change your password</p>

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password"
                               class="form-control @error('current_password') is-invalid @enderror"
                               id="current_password"
                               name="current_password"
                               placeholder="Enter current password">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password"
                                   class="form-control @error('new_password') is-invalid @enderror"
                                   id="new_password"
                                   name="new_password"
                                   placeholder="Enter new password">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimum 8 characters</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password"
                                   class="form-control"
                                   id="new_password_confirmation"
                                   name="new_password_confirmation"
                                   placeholder="Confirm new password">
                        </div>
                    </div>

                    <hr>

                    {{-- Action Buttons --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('profile.show') }}" class="btn btn-light">
                            <i class='bx bx-arrow-back'></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class='bx bx-save'></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
</div>

{{-- Delete Profile Image Form --}}
<form id="delete-image-form" action="{{ route('profile.image.delete') }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection



@section('script-bottom')
<script>
    // Preview image before upload
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('profile-preview');
            preview.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Delete profile image
    function deleteProfileImage() {
        if (confirm('Are you sure you want to delete your profile image?')) {
            document.getElementById('delete-image-form').submit();
        }
    }
</script>
@endsection
