@extends('layouts.admin.index')

@section('content')
<div class="container mt-4">
    {{-- Welcome Message --}}
    <div class="mb-4">
        <h4 class="fw-bold">Welcome back, {{ Auth::user()->name }} 👋</h4>
        <p class="text-muted">Here’s what’s happening with your app today.</p>
    </div>

    {{-- Overview Cards --}}
    {{-- <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-sm">
                <div class="card-body">
                    <h6>Total Users</h6>
                    <h3>{{ $usersCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-sm">
                <div class="card-body">
                    <h6>Active Posts</h6>
                    <h3>{{ $postsCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark shadow-sm">
                <div class="card-body">
                    <h6>Pending Comments</h6>
                    <h3>{{ $pendingCommentsCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white shadow-sm">
                <div class="card-body">
                    <h6>Today's Signups</h6>
                    <h3>{{ $todaysSignups }}</h3>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Users</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $usersCount }}</div>
                      </div>
                      <div class="col-auto px-2">
                          <i class="fa-solid fa-users-gear fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Active Posts</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $postsCount }}</div>
                      </div>
                      <div class="col-auto px-2">
                          <i class="fa-solid fa-file-lines fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-danger shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Pending Comments</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingCommentsCount }}</div>
                      </div>
                      <div class="col-auto px-2">
                          <i class="fa-solid fa-comments fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>

 

      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Today's Signups</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $todaysSignups }}</div>
                      </div>
                      <div class="col-auto px-2">
                          <i class="fa-solid fa-user fa-2x text-gray-300"></i>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

    {{-- Quick Actions --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Quick Actions</h5>
        <div>
            <a href="{{route('posts.create')}}" class="btn btn-outline-primary">
                <i class="fas fa-plus"></i> Add Post
            </a>
            <a href="{{ route('users.index') }}" class="btn btn-primary"><i class="fa-solid fa-users-gear"></i> Manage Users</a>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
            <h6 class="mb-0">Recent Users</h6>
        </div>
        <div class="card-body p-0">
            <table class="table mb-0 table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentUsers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                            <td>
                                <span class="badge {{ $user->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
