@extends('layouts.admin.index')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-center">Categories Table</h2>
    <div class="row m-auto" style="width: 70%">
        <div class="card p-0">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <input type="text" id="searchInput" class="form-control w-100 w-md-50" placeholder="Search by name..." style="max-width: 400px;">
                
                    <!-- Trigger Button -->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="fas fa-plus"></i> Add Category
                    </button>
                </div>
                
                
                <!-- Add Category Modal -->
                <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('categories.store') }}" method="POST" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <label for="categoryName" class="form-label">Category Name</label>
                                    <input type="text" name="name" id="categoryName" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="categoryDescription" class="form-label">Category Description</label>
                                    <input type="text" name="description" id="categoryDescription" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Category</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Category Modal -->
                <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" id="editCategoryForm" class="modal-content" action="{{ route('categories.update', 'category') }}">
                            @csrf
                            @method('PUT') {{-- Laravel's method spoofing --}}
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="editCategoryId">
                                <div class="mb-2">
                                    <label for="editCategoryName" class="form-label">Category Name</label>
                                    <input type="text" name="name"  id="editCategoryName" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editCategoryDescrition" class="form-label">Category Description</label>
                                    <input type="text" name="description" id="editCategoryDescrition" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Update Category</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Delete Category Modal -->
                <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" id="deleteCategoryForm" class="modal-content">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteCategoryModalLabel">Delete Category</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong id="deleteCategoryName">this category</strong>?</p>
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
                            <th onclick="sortTable(0)" style="cursor:pointer;">ID ⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Name ⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Description ⬍</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @if ($categories->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">No categories found.</td>
                            </tr>
                        @else
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <a 
                                        href="#" 
                                        class="text-success me-3 edit-btn text-decoration-none" 
                                        data-id="{{ $category->id }}" 
                                        data-name="{{ $category->name }}" 
                                        data-description="{{ $category->description ?? '' }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editCategoryModal"
                                        title="Edit Category">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a 
                                        href="#" 
                                        class="text-danger delete-btn" 
                                        data-id="{{ $category->id }}" 
                                        data-name="{{ $category->name }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteCategoryModal"
                                        title="Delete Category">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    {{-- <a href="{{ route('categories.destroy', $category->id) }}" class="text-danger" onclick="event.preventDefault(); document.getElementById('deleteCategoryForm').submit();" title="Delete Category">
                                        <i class="fas fa-trash-alt fa-lg"></i>
                                    <form id="deleteCategoryForm" action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
                            </td>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                
                    {{ $categories->links() }}
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>

// EDIT CATEGORY
    document.addEventListener('DOMContentLoaded', () => {
        const editButtons = document.querySelectorAll('.edit-btn');
        const form = document.getElementById('editCategoryForm');
        const nameInput = document.getElementById('editCategoryName');
        const descriptionInput = document.getElementById('editCategoryDescrition');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const description = this.dataset.description;

                nameInput.value = name;
                descriptionInput.value = description;
                form.action = `/admin/categories/${id}`; // <-- update this if your route is different
            });
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const deleteForm = document.getElementById('deleteCategoryForm');
        const deleteCategoryName = document.getElementById('deleteCategoryName');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;

                deleteCategoryName.textContent = name;
                deleteForm.action = `/admin/categories/${id}`;
            });
        });
    });

</script>
@endsection
