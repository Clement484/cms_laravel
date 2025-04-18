@extends('layouts.admin.index')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">📝 Add New Post</h5>
                    <a href="{{ route('posts.index') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Post Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter post title..." value="{{ old('title') }}">
                            @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="content" rows="5" class="form-control @error('content') is-invalid @enderror" placeholder="Write something awesome...">{{ old('content') }}</textarea>
                            @error('content') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id"  class="form-select @error('category_id') is-invalid @enderror">
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- <!-- Tags -->
                        <div class="mb-3">
                            <label class="form-label">Tags (comma separated)</label>
                            <input type="text" name="tags" class="form-control" placeholder="e.g. tech, laravel, design" value="{{ old('tags') }}">
                        </div> --}}

                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label class="form-label">Featured Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload me-2"></i> Publish Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.querySelector('form').addEventListener('submit', function () {
        const editor = document.querySelector("trix-editor");
        const contentField = document.querySelector("input[name='content']");
        contentField.value = editor.editor.getDocument().toString();
    });
</script>
@endsection
