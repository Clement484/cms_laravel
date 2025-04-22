@extends('layouts.admin.index')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4 text-center">All Messages</h2>
    <div class="row m-auto" style="width: 90%">
        <div class="card p-0">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <input type="text" id="searchInput" class="form-control w-100 w-md-50" placeholder="Search by name..." style="max-width: 400px;">
                
                    <!-- Trigger Button -->
                    {{-- <a href="{{route('posts.create')}}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Messages
                    </a> --}}
                </div>
                
                <!-- Delete Message Modal -->
                <div class="modal fade" id="deleteMessageModal" tabindex="-1" aria-labelledby="deleteMessageModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" id="deleteMessageForm" class="modal-content">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="deleteMessageModalLabel">Delete Message</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong id="deleteMessageName">this Message</strong>'s Message?</p>
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
                            <th onclick="sortTable(1)" style="cursor:pointer;">Subject⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Message⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Name⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Email⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Status⬍</th>
                            <th onclick="sortTable(1)" style="cursor:pointer;">Date⬍</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @if ($messages->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">No Messages found.</td>
                            </tr>
                        @else
                        @foreach ($messages as $message)
                            <tr>
                                <td>{{ $message->id }}</td>
                                <td title="{{$message->subject}}">
                                    <a href="" class="text-decoration-none">
                                        {{ Str::limit($message->subject, 30, '...') }}
                                    </a>
                                </td>
                                <td title="{{$message->content}}">{{ Str::limit($message->content, 50, '...') }}</td>
                                <td>
                                    <a href="" class="text-decoration-none">
                                        {{ $message->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="mailto:{{ $message->email }}" class="text-decoration-none">
                                        {{ $message->email }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $message->status === 'read' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($message->status) }}
                                    </span>
                                </td>
                                <td>{{ $message->created_at->diffForHumans() }}</td>
                                <td>
                                    @if ($message->status == 'unread')
                                    <form action="{{ route('messages.read', $message->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-link text-success p-0 m-0" title="Read Message">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                    </form>
                                    
                                    @else
                                    <form action="{{ route('messages.unread', $message->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-link text-danger p-0 m-0" title="Reject Message">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    </form>
                                    
                                    @endif
                                    <a 
                                        href="#" 
                                        class="text-danger delete-btn ml-2" 
                                        data-id="{{ $message->id }}" 
                                        data-name="{{ $message->name }}" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteMessageModal"
                                        title="Delete Message">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                
                {{ $messages->links() }}
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const deleteForm = document.getElementById('deleteMessageForm');
        const deleteMessageName = document.getElementById('deleteMessageName');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;

                deleteMessageName.textContent = name;
                deleteForm.action = `/admin/messages/${id}`;
            });
        });
    });
</script>
@endsection