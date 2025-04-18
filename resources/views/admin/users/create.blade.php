@extends('layouts.admin.index')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Create New User</h2>

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
                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        {{-- Role --}}
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="moderator">Moderator</option>
                            </select>
                            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Date of Birth --}}
                        <div class="mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control">
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                        </div>

                        {{-- Gender --}}
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="" disabled selected>Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                        </div>

                        {{-- Bio --}}
                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" class="form-control" rows="3">{{ old('bio') }}</textarea>
                        </div>

                        {{-- Profile Photo --}}
                        <div class="mb-3">
                            <label class="form-label">Profile Photo</label>
                            <input type="file" name="profile_photo" class="form-control">
                        </div>

                        {{-- Submit --}}
                        <div class="text-end">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
