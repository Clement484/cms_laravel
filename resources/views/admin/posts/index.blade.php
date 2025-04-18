@extends('layouts.admin.index')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-center">All Posts</h2>
    <div class="row m-auto" style="width: 90%">
        <div class="card p-0">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <input type="text" id="searchInput" class="form-control w-100 w-md-50" placeholder="Search by name..." style="max-width: 400px;">
                
                    <!-- Trigger Button -->
                    <a href="{{route('posts.create')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Post
                    </a>
                </div>
                
                <!-- Delete Post Modal -->
                <div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" id="deletePostForm" class="modal-content">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deletePostModalLabel">Delete Post</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong id="deletePostName">this Post</strong>?</p>
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
                            <th onclick="sortTable(1)" style="cursor:pointer;">Title⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Content⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Image⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Author⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Category⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Comments⬍</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @if ($posts->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">No Post found.</td>
                            </tr>
                        @else
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td title="{{$post->title}}"><a href="{{route('homepage.blog_details', $post->id)}}" class="text-decoration-none">{{ Str::limit($post->title, 30, '...') }}</a></td>
                                <td title="{{$post->content}}">{{ Str::limit($post->content, 40, '...') }}</td>
                                <td>
                                    @if ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td><a href="{{route('users.show', $post->user->id)}}" class="text-decoration-none">{{ $post->user->name }}</a></td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->comments->count() }}</td>
                                <td>
                                    <a 
                                        href="{{ route('posts.edit', $post->id) }}" 
                                        class="text-success me-3 edit-btn" 
                                        data-id="{{ $post->id }}" 
                                        data-title="{{ $post->title }}" 
                                        data-content="{{ $post->content ?? '' }}" 
                                        title="Edit Post">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a 
                                        href="#" 
                                        class="text-danger delete-btn" 
                                        data-id="{{ $post->id }}" 
                                        data-title="{{ $post->title }}"  
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deletePostModal"
                                        title="Delete Post">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                
                {{ $posts->links() }}
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const deleteForm = document.getElementById('deletePostForm');
        const deletePostName = document.getElementById('deletePostName');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.title;

                deletePostName.textContent = name;
                deleteForm.action = `/admin/posts/${id}`;
            });
        });
    });
</script>
@endsection
