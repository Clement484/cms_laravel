@extends('layouts.admin.index')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Post</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <small class="text-muted">Leave blank to keep the current image</small>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Update Post</button>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary w-100">Cancel</a>
                        </div>

                    </form>
                    <div class="d-flex justify-content-between mt-3 px-2 text-muted small">
                        <div>
                            Created: {{ $post->created_at->format('M d, Y - H:i') }}<br>
                            <span>By: {{ $post->user->name }}</span>
                        </div>
                        <div>
                            Last updated: {{ $post->updated_at->diffForHumans() }}<br>
                            <span>By: {{ $post->user->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
