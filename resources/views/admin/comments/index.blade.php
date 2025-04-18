@extends('layouts.admin.index')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-center">All Comments</h2>
    <div class="row m-auto" style="width: 90%">
        <div class="card p-0">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <input type="text" id="searchInput" class="form-control w-100 w-md-50" placeholder="Search by name..." style="max-width: 400px;">
                
                    <!-- Trigger Button -->
                    {{-- <a href="{{route('posts.create')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Comments
                    </a> --}}
                </div>
                
                <!-- Delete Comment Modal -->
                <div class="modal fade" id="deleteCommentModal" tabindex="-1" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" id="deleteCommentForm" class="modal-content">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteCommentModalLabel">Delete Post</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong id="deleteCommentName">this Post</strong>'s comment?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>


                {{-- table --}}
                <table class="table table-hover table-bordered" id="customTable">
                    <thead class="table-light">
                        <tr>
                            <th onclick="sortTable(0)" style="cursor:pointer;">ID⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Comment⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Post⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Author⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Status⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Date⬍</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @if ($comments->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">No Comments found.</td>
                            </tr>
                        @else
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td title="{{$comment->content}}">{{ Str::limit($comment->content, 50, '...') }}</td>
                                <td title="{{$comment->post?->title}}">
                                    <a href="{{route('homepage.blog_details', $comment->post->id)}}" class="text-decoration-none">
                                        {{ Str::limit($comment->post?->title ?? 'No Post', 30, '...') }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('users.show', $comment->user->id)}}" class="text-decoration-none">
                                        {{ $comment->user->name }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $comment->status === 'approved' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($comment->status) }}
                                    </span>
                                </td>
                                <td>{{ $comment->created_at->diffForHumans() }}</td>
                                <td>
                                    @if ($comment->status == 'spam')
                                    <form action="{{ route('comments.approve', $comment->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-link text-success p-0 m-0" title="Approve Comment">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                    </form>
                                    
                                    @else
                                    <form action="{{ route('comments.spam', $comment->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-link text-danger p-0 m-0" title="Reject Comment">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </form>
                                    
                                    @endif
                                    <a 
                                        href="#" 
                                        class="text-danger delete-btn ml-2" 
                                        data-id="{{ $comment->id }}" 
                                        data-name="{{ $comment->user->name }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteCommentModal"
                                        title="Delete Category">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                
                {{ $comments->links() }}
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const deleteForm = document.getElementById('deleteCommentForm');
        const deleteCommentName = document.getElementById('deleteCommentName');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;

                deleteCommentName.textContent = name;
                deleteForm.action = `/admin/comments/${id}`;
            });
        });
    });
</script>
@endsection
