@extends('layouts.admin.index')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="mb-0">All Users</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-1"></i> Add New User
        </a>
    </div>

    <div class="row g-4">
        @foreach ($users as $user)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 border-0 shadow-sm user-card position-relative">
                    <a href="{{ route('users.show', $user->id) }}" class="text-decoration-none text-dark">
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/'. (!empty($user->profile_photo) ? $user->profile_photo : 'users/default.png')) }}" class="rounded-circle mb-3" width="80" height="80" alt="User Avatar">
                            <h5 class="mb-1">{{ $user->name }}</h5>
                            <p class="text-muted small mb-1">{{ $user->email }}</p>

                            {{-- Role badge --}}
                            <span class="badge 
                                {{ $user->role == 'admin' ? 'bg-dark text-white' : 
                                   ($user->role == 'moderator' ? 'bg-secondary text-white' : 'bg-light text-dark border') }}">
                                {{ ucfirst($user->role ?? 'User') }}
                            </span>

                            <ul class="list-unstyled mt-3 small text-start">
                                <li><strong>Age:</strong> {{ \Carbon\Carbon::parse($user->date_of_birth)->age }} years</li>
                                <li><strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}</li>
                                <li><strong>Status:</strong> 
                                    <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </a>

                    {{-- Action icons --}}
                    <div class="card-footer d-flex justify-content-around border-top bg-light">
                        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#changePasswordModal" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" title="Change Password">
                            <i class="fas fa-key"></i>
                        </a>
                        <form action="{{route('users.lock', $user->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-link p-0 m-0 text-secondary" title="{{ $user->is_active ? 'Lock' : 'Unlock' }}">
                                <i class="fas {{ $user->is_active ? 'fa-lock-open' : 'fa-lock' }}"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        {{ $users->links() }}
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="deleteUserForm" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Delete User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong id="deleteUserName">this user</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
        </form>
    </div>
</div>

{{-- Change Password Modal --}}
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="changePasswordForm" class="modal-content" action="">
            @csrf
            @method('PATCH')
            <div class="modal-header bg-info text-dark">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                {{-- New Password --}}
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" name="password" id="new_password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="user_id" id="changeUserId">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-info">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const deleteModal = document.getElementById('deleteUserModal');
    const deleteForm = document.getElementById('deleteUserForm');
    const deleteName = document.getElementById('deleteUserName');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const userId = button.getAttribute('data-user-id');
        const userName = button.getAttribute('data-user-name');
        deleteForm.action = `/admin/users/${userId}`;
        deleteName.textContent = userName;
    });

    const changePasswordModal = document.getElementById('changePasswordModal');
    const changeForm = document.getElementById('changePasswordForm');

    changePasswordModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const userId = button.getAttribute('data-user-id');
        changeForm.action = `/admin/users/${userId}/change_password`;
    });
</script>
@endsection
