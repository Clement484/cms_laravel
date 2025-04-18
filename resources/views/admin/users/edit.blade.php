@extends('layouts.admin.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit {{ $user->name }}'s Profile</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">
                <div class="card-body">

                    {{-- Global Error Alert --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="moderator" {{ $user->role === 'moderator' ? 'selected' : '' }}>Moderator</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="is_active" class="form-select @error('is_active') is-invalid @enderror">
                                <option value="1" {{ $user->is_active ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Date of Birth --}}
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" 
                            value="{{ old('date_of_birth', $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') : '') }}"
                                class="form-control @error('date_of_birth') is-invalid @enderror">
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Gender --}}
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="" disabled {{ $user->gender ? '' : 'selected' }}>Select Gender</option>
                                <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ $user->gender === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" 
                                class="form-control @error('phone') is-invalid @enderror">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Location --}}
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}" 
                                class="form-control @error('address') is-invalid @enderror">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Bio --}}
                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="4">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Profile Photo --}}
                        <div class="mb-3">
                            <label class="form-label">Profile Photo</label>
                            <input type="file" name="profile_photo" class="form-control @error('profile_photo') is-invalid @enderror">
                            @error('profile_photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($user->profile_photo_url)
                                <div class="mt-2">
                                    <img src="{{ $user->profile_photo_url }}" alt="Avatar" class="rounded-circle" width="60" height="60">
                                </div>
                            @endif
                        </div>

                        {{-- Submit --}}
                        <div class="text-end">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>

                    </form>
                    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
