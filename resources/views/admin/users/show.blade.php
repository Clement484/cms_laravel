@extends('layouts.admin.index')

@section('styles')
<style>
    .badge {
        font-size: 0.8rem;
        padding: 0.4em 0.6em;
    }

    .card-body h5 {
        border-bottom: 1px solid #eee;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">

    {{-- Header --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body d-flex align-items-center justify-content-between flex-wrap">
            <div class="d-flex align-items-center gap-4">
                <img src="{{asset('storage/'. (!empty($user->profile_photo) ? $user->profile_photo : 'users/default.png'))}}" 
                     class="rounded-circle shadow" width="100" height="100" alt="Avatar">

                <div>
                    <h3 class="mb-0">{{ $user->name }}</h3>
                    <p class="text-muted mb-1">{{ $user->email }}</p>

                    <span class="badge 
                        {{ $user->role === 'admin' ? 'bg-dark' : 
                           ($user->role === 'moderator' ? 'bg-secondary' : 'bg-light text-dark border') }}">
                        {{ ucfirst($user->role ?? 'User') }}
                    </span>
                    <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <div class="mt-3 mt-md-0">
                <a href="{{route('users.edit', $user->id)}}" class="btn btn-outline-primary me-2"><i class="fas fa-edit me-1"></i>Edit</a>
                <a  href="#" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" title="Delete">
                <i class="fas fa-trash-alt me-1"></i>Delete</a>
                </a>
            </div>
        </div>
    </div>

    {{-- Details Section --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Personal Info</h5>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Name:</strong> {{ $user->name }}</li>
                        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Age:</strong> {{ $user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->age . ' years' : 'N/A' }}</li>
                        <li><strong>Gender:</strong> {{ ucfirst($user->gender ?? 'N/A') }}</li>
                        <li><strong>Phone:</strong> {{ $user->phone ?? 'N/A' }}</li>
                        <li><strong>Location:</strong> {{ $user->address ?? 'N/A' }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Account Info</h5>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Role:</strong> {{ ucfirst($user->role ?? 'User') }}</li>
                        <li><strong>Status:</strong> {{ $user->is_active ? 'Active' : 'Inactive' }}</li>
                        <li><strong>Joined:</strong> {{ $user->created_at->format('F d, Y') }}</li>
                        <li><strong>Last Updated:</strong> {{ $user->updated_at->diffForHumans() }}</li>
                        <li><strong>User ID:</strong> #{{ $user->id }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Optional Bio Section --}}
    @if($user->bio)
    <div class="card mt-4 border-0 shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Bio</h5>
            <p>{{ $user->bio }}</p>
        </div>
    </div>
    @endif



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

    
</script>
@endsection
